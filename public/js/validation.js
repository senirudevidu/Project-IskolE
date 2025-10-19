import { validationRules } from "./validationRules.js";
import { validators, asyncFns } from "./validator.js";

// Utility: check if element is visible (not display:none and within a visible container)
function isElementVisible(el) {
  if (!el) return false;
  const style = window.getComputedStyle(el);
  if (style.display === "none" || style.visibility === "hidden") {
    return false;
  }
  // If the element or any ancestor is display:none, offsetParent will be null (except for fixed positioning)
  if (!el.offsetParent && style.position !== "fixed") return false;
  return true;
}

export function showError(input, message) {
  let errorElement = input.nextElementSibling;
  if (!errorElement || !errorElement.classList.contains("error-message")) {
    errorElement = document.createElement("div");
    errorElement.className = "error-message";
    input.parentNode.insertBefore(errorElement, input.nextSibling);
  }
  errorElement.textContent = message;
  input.classList.add("error");
}

export function clearError(input) {
  let errorElement = input.nextElementSibling;
  if (errorElement && errorElement.classList.contains("error-message")) {
    errorElement.textContent = "";
  }
  input.classList.remove("error");
}

export async function validateField(input) {
  const fieldId = input.id;
  const value = input.value.trim();
  const rules = validationRules[fieldId];
  if (!rules) return true;

  // Dynamic required logic for role-specific fields
  let isRequired = !!rules.required;
  if (fieldId === "grade" || fieldId === "class" || fieldId === "subject") {
    const roleEl = document.getElementById("userType");
    const roleVal = roleEl ? roleEl.value : undefined;
    if (fieldId === "grade") {
      isRequired = roleVal === "student"; // grade mandatory only for students
    } else if (fieldId === "class") {
      isRequired = roleVal === "student" || roleVal === "teacher"; // class required for student & teacher
    } else if (fieldId === "subject") {
      isRequired = roleVal === "teacher"; // subject required for teacher
    }
  }

  // If not required and empty -> pass without further checks
  if (!isRequired && value === "") {
    clearError(input);
    return true;
  }

  // Required
  if (isRequired && !validators.required(value)) {
    showError(input, rules.message?.required || "This field is required");
    return false;
  }

  // Min length
  if (rules.minlength && !validators.minlength(value, rules.minlength)) {
    showError(input, rules.message.minlength);
    return false;
  }

  // Max length
  if (rules.maxlength && !validators.maxlength(value, rules.maxlength)) {
    showError(input, rules.message.maxlength);
    return false;
  }

  // Pattern
  if (
    rules.pattern &&
    value !== "" &&
    !validators.pattern(value, rules.pattern)
  ) {
    showError(input, rules.message.pattern);
    return false;
  }

  // Match another field
  if (rules.match && !validators.match(value, rules.match)) {
    showError(input, rules.message.match);
    return false;
  }
  // Future date (e.g., input must be after today or after N days)
  if (rules.future) {
    const offsetDays = typeof rules.future === "number" ? rules.future : 1; // true -> 1 day
    // delegate to validators.future(value, offsetDays) which should return a boolean
    if (!validators.future(value, offsetDays)) {
      showError(input, rules.message.future || "Must be in the future");
      return false;
    }
  }
  // Minimum age in years (date must be at least N years ago)
  if (rules.minAge && !validators.minAge(value, rules.minAge)) {
    showError(
      input,
      (rules.message && (rules.message.minAge || rules.message.required)) ||
        "Invalid date"
    );
    return false;
  }
  // Async validation
  if (rules.async && asyncFns[rules.async]) {
    const available = await asyncFns[rules.async](value);
    if (!available) {
      showError(input, rules.message.async);
      return false;
    }
  }

  clearError(input);
  return true;
}

export function createValidator({ formSelector, onValid, onInvalid }) {
  // const form = document.querySelector(formSelector);
  // if (!form) return;
  // form.addEventListener("submit", async (e) => {
  //   let isValid = true;
  //   const allInputs = Array.from(form.querySelectorAll("input, select"));
  //   const inputs = allInputs.filter((el) => isElementVisible(el));
  //   for (const input of inputs) {
  //     const valid = await validateField(input);
  //     if (!valid) isValid = false;
  //   }
  //   if (!isValid) {
  //     // Block submission when invalid
  //     e.preventDefault();
  //     if (typeof onInvalid === "function") {
  //       try {
  //         await onInvalid(form);
  //       } catch (err) {
  //         console.error("onInvalid callback error:", err);
  //       }
  //     }
  //     return;
  //   }
  //   // Valid: if onValid is provided, treat as AJAX and block native submit
  //   if (typeof onValid === "function") {
  //     e.preventDefault();
  //     try {
  //       const res = await onValid(form);
  //       if (res === false) return; // allow callback to block submit
  //     } catch (err) {
  //       console.error("onValid callback error:", err);
  //     }
  //     return; // do not perform native submit when using AJAX handler
  //   }
  //   // Otherwise, allow native form submission (don't call preventDefault)
  // });

  const form = document.querySelector(formSelector);
  if (!form) return;

  // Helper: check if element is visible
  function isVisible(el) {
    return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
  }

  // Helper: simple field validation
  async function validateField(input) {
    // Example rules — you can customize these
    const value = input.value.trim();
    const required = input.hasAttribute("required");

    if (required && value === "") {
      input.classList.add("invalid");
      return false;
    }

    input.classList.remove("invalid");
    return true;
  }

  // Handle form submission
  form.addEventListener("submit", async (e) => {
    const inputs = Array.from(
      form.querySelectorAll("input, select, textarea")
    ).filter(isVisible);

    let allValid = true;

    for (const input of inputs) {
      const valid = await validateField(input);
      if (!valid) allValid = false;
    }

    if (!allValid) {
      e.preventDefault();
      if (typeof onInvalid === "function") {
        try {
          await onInvalid(form);
        } catch (err) {
          console.error("onInvalid error:", err);
        }
      }
      return;
    }

    if (typeof onValid === "function") {
      e.preventDefault(); // use custom (AJAX) handling
      try {
        const result = await onValid(form);
        if (result === false) return;
      } catch (err) {
        console.error("onValid error:", err);
      }
    }
    // else: allow normal form submission
  });
}
