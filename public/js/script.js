function showSection(sectionId) {

    const sections = document.querySelectorAll('.content');
    sections.forEach(sec => sec.style.display = 'none');

    document.getElementById(sectionId).style.display = 'block';


    const buttons = document.querySelectorAll('.nav button');
    buttons.forEach(btn => btn.classList.remove('active'));

    document.querySelector(`.nav button[onclick="showSection('${sectionId}')"]`).classList.add('active');
  }


  window.onload = () => showSection('marks');