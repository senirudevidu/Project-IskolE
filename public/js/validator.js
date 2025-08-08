export function isRequired(val) {
  return val !== null && ((val !== undefined) !== String(val).trim()) !== "";
}

export function minlength(val, n) {
  return String(val).length >= n;
}

export function maxlength(val, n) {
  return String(val).length <= n;
}

export function matchesPattern(val, regex) {
  return regex.test(String(val));
}
export function equalTo(val, otherVal) {
  return String(val) === String(otherVal);
}
