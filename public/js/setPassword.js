(function () {
  const form = document.getElementById("setPasswordForm");
  const pw = document.getElementById("password");
  const cpw = document.getElementById("confirmPassword");
  const pwErr = document.getElementById("passwordError");
  const cpwErr = document.getElementById("confirmError");
  const strengthBar = document.getElementById("strengthBar");

  const C = {
    len: document.getElementById("c_len"),
    low: document.getElementById("c_low"),
    up: document.getElementById("c_up"),
    num: document.getElementById("c_num"),
    sp: document.getElementById("c_sp"),
  };

  function updateCriterion(el, ok) {
    el.classList.toggle("ok", ok);
    el.classList.toggle("bad", !ok);
  }

  function evaluate(p) {
    const rules = {
      len: p.length >= 8,
      low: /[a-z]/.test(p),
      up: /[A-Z]/.test(p),
      num: /\d/.test(p),
      sp: /[!@#$%^&*(),.?":{}|<>\-_[\\/+=]/.test(p),
    };
    const score = Object.values(rules).filter(Boolean).length;
    return { score, rules };
  }

  function paintStrength(score) {
    const pct = (score / 5) * 100;
    strengthBar.style.width = pct + "%";
    let color = "#e53935";
    if (score >= 4) color = "#2e7d32";
    else if (score === 3) color = "#f9a825";
    else if (score === 2) color = "#fb8c00";
    strengthBar.style.background = color;
  }

  function validatePasswordField() {
    const p = pw.value.trim();
    const { score, rules } = evaluate(p);
    updateCriterion(C.len, rules.len);
    updateCriterion(C.low, rules.low);
    updateCriterion(C.up, rules.up);
    updateCriterion(C.num, rules.num);
    updateCriterion(C.sp, rules.sp);
    paintStrength(score);
    pwErr.textContent = "";
    if (!rules.len)
      pwErr.textContent = "Password must be at least 8 characters.";
    return score === 5; // require all criteria
  }

  function validateConfirmField() {
    const match = cpw.value === pw.value && cpw.value.trim() !== "";
    cpwErr.textContent = match ? "" : "Passwords do not match.";
    return match;
  }

  function toggleVis(e) {
    const targetId = e.target.getAttribute("data-target");
    const input = document.getElementById(targetId);
    if (!input) return;
    input.type = input.type === "password" ? "text" : "password";
    e.target.textContent = input.type === "password" ? "Show" : "Hide";
  }

  document
    .querySelectorAll(".toggle-visibility")
    .forEach((t) => t.addEventListener("click", toggleVis));
  pw.addEventListener("input", () => {
    validatePasswordField();
    validateConfirmField();
  });
  cpw.addEventListener("input", validateConfirmField);

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const ok1 = validatePasswordField();
    const ok2 = validateConfirmField();
    if (ok1 && ok2) {
      form.submit();
    }
  });

  // Initialize view
  paintStrength(0);
})();
