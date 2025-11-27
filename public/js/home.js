// Creation Task date validation
const dateInput = document.getElementById('date');
const today = new Date();

today.setDate(today.getDate() + 1);

const minDate = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-'+ String(today.getDate()).padStart(2, '0');
dateInput.setAttribute('min', minDate);

// Updating Task date validation
const editModal = document.getElementById('editTaskModal');
editModal.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget;

    let id = button.getAttribute('data-id');
    let name = button.getAttribute('data-name');
    let priority = button.getAttribute('data-priority');
    let deadline = button.getAttribute('data-deadline');

    const editNameInput = document.getElementById('editName');
    const editPrioritySelect = document.getElementById('editPriority');
    const editDeadlineInput = document.getElementById('editDeadline');

    editNameInput.value = name;
    editPrioritySelect.value = priority;
    editDeadlineInput.value = deadline;

    const todayModal = new Date();
    todayModal.setDate(todayModal.getDate() + 1);
    const minDateModal = todayModal.getFullYear() + '-' + String(todayModal.getMonth() + 1).padStart(2, '0') + '-' + String(todayModal.getDate()).padStart(2, '0');
    editDeadlineInput.setAttribute('min', minDateModal);

    document.getElementById('editTaskForm').action = "/tasks/" + id;
});
