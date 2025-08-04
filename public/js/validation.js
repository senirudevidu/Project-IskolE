import "./validationRules";
import { validationRules } from "./validationRules";

export function validateField(input) {
  const fieldId = input.id;
  const value = input.value.trim();
  const rules = validationRules.validationRules[fieldId];

  // display error
  let errorElement = input.nextElementSibling?.classList.contains(
    "error-message"
  )
    ? input.nextElementSibling
    : document.getElementById(`${fieldId}Error`);

  if (errorElement) {
    errorElement.textContent = "";
    errorElement.style.display = "none";
    input.classList.remove("error", "valid");
  }

  if (!rules) {
    input.classList.add("valid");
    return true;
  }
}
