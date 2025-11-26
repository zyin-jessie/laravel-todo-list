const dateInput = document.getElementById('date');
const today = new Date();

today.setDate(today.getDate() + 1);

const minDate = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-'+ String(today.getDate()).padStart(2, '0');
dateInput.setAttribute('min', minDate);
