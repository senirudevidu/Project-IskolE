// Basic validation functions
export const validators = {
  required: (value) => value.trim() !== "",
  minlength: (value, length) => value.length >= length,
  maxlength: (value, length) => value.length <= length,
  length: (value, length) => value.length == length,
  pattern: (value, regex) => regex.test(value),
  future: (value) => {
    const v = typeof value === "string" ? value.trim() : value;
    if (!v) return false;
    // If value is a date-only string like "YYYY-MM-DD", construct a local date
    // to avoid timezone shifts that can make the date appear in the past.
    let d;
    if (/^\d{4}-\d{2}-\d{2}$/.test(v)) {
      const [y, m, day] = v.split("-").map(Number);
      d = new Date(y, m - 1, day);
    } else {
      d = new Date(v);
    }
    return !isNaN(d.getTime()) && d.getTime() > Date.now();
  },
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