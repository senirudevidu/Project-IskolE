// import "./validationRules";
import { validationRules } from "./validationRules.js";

// export function validateField(input) {
//   const fieldId = input.id;
//   const value = input.value.trim();
//   const rules = validationRules.validationRules[fieldId];

//   // display error
//   let errorElement = input.nextElementSibling?.classList.contains(
//     "error-message"
//   )
//     ? input.nextElementSibling
//     : document.getElementById(`${fieldId}Error`);

//   if (errorElement) {
//     errorElement.textContent = "";
//     errorElement.style.display = "none";
//     input.classList.remove("error", "valid");
//   }

//   if (!rules) {
//     input.classList.add("valid");
//     return true;
//   }
// }

// // Check required field
// if (rules.required && !value) {
//   showError(
//     input,
//     errorElement,
//     rules.message?.required || "This field is required"
//   );
//   return false;
// }

// // Check min length
// if (rules.minlength && value.length < rules.minlength) {
//   showError(
//     input,
//     errorElement,
//     rules.message?.minlength || `Minimum ${rules.minlength} characters required`
//   );
//   return false;
// }

// // Check max length
// if (rules.maxlength && value.length > rules.maxlength) {
//   showError(
//     input,
//     errorElement,
//     rules.message?.maxlength || `Maximum ${rules.maxlength} characters allowed`
//   );
//   return false;
// }

// // Check exact length (like for phone numbers)
// if (rules.length && value.length !== rules.length) {
//   showError(
//     input,
//     errorElement,
//     rules.message?.length || `Must be exactly ${rules.length} characters`
//   );
//   return false;
// }

// // Check pattern
// if (rules.pattern && !rules.pattern.test(value)) {
//   showError(input, errorElement, rules.message?.pattern || "Invalid format");
//   return false;
// }

// // If no rules exist for this field, consider it valid
// if (!rules) {
//   input.classList.add("valid");
//   return true;
// }

// function showError(input, errorElement, message) {
//   input.classList.add("error");
//   input.classList.remove("valid");

//   if (errorElement) {
//     errorElement.textContent = message;
//     errorElement.style.display = "block";
//   }

//   // Accessibility improvement
//   input.setAttribute("aria-invalid", "true");
//   if (errorElement) {
//     input.setAttribute("aria-describedby", errorElement.id);
//   }
//   return;
// }

export function validateField(an) {}
