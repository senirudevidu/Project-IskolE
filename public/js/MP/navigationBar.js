export function navigationBar() {
  const navItems = document.querySelectorAll(".nav-item");
  const sections = document.querySelectorAll(".bottem");

  const setActive = (targetId) => {
    // Toggle active class on nav items using data-target when available
    navItems.forEach((nav) => {
      const navTarget =
        nav.getAttribute("data-target") || nav.textContent.trim().toLowerCase();
      if (navTarget === targetId) nav.classList.add("active");
      else nav.classList.remove("active");
    });

    // Show only the requested section
    sections.forEach((section) => {
      section.style.display = section.id === targetId ? "flex" : "none";
    });
  };

  // Wire click handlers: switch section and update URL hash
  navItems.forEach((item) => {
    item.addEventListener("click", () => {
      const sectionId =
        item.getAttribute("data-target") ||
        item.textContent.trim().toLowerCase();
      setActive(sectionId);
      // Update hash without reloading
      if (sectionId) {
        if (window.location.hash !== `#${sectionId}`) {
          history.pushState(null, "", `#${sectionId}`);
        }
      }
    });
  });

  // On load, respect URL hash if present; fallback to the nav item already marked active
  const initialHash = (window.location.hash || "").replace(/^#/, "");
  const defaultTarget =
    document.querySelector(".nav-item.active")?.getAttribute("data-target") ||
    document
      .querySelector(".nav-item.active")
      ?.textContent?.trim()
      ?.toLowerCase() ||
    "announcements";
  setActive(initialHash || defaultTarget);

  // Keep in sync when hash changes via browser navigation
  window.addEventListener("hashchange", () => {
    const hash = (window.location.hash || "").replace(/^#/, "");
    if (hash) setActive(hash);
  });
}
