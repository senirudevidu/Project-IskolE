// Basic validation functions
export const validators = {
  required: (value) => value.trim() !== "",
  minlength: (value, length) => value.length >= length,
  maxlength: (value, length) => value.length <= length,
  pattern: (value, regex) => regex.test(value),
  match: (value, fieldId) => {
    const otherField = document.getElementById(fieldId);
    return otherField && value === otherField.value;
  },
};

// Async validation functions (simulate API calls)
export const asyncFns = {
  async checkUsernameAvailable(value) {
    await new Promise((r) => setTimeout(r, 300)); // Simulated delay
    return value.toLowerCase() !== "taken";
  },

  async checkEmailAvailable(value) {
    await new Promise((r) => setTimeout(r, 300));
    return value.toLowerCase() !== "used@example.com";
  },
};
