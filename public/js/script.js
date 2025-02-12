// Confirmação de exclusão de tarefa
function confirmDelete(taskId) {
    const confirmation = confirm("Tem certeza que deseja excluir esta tarefa?");
    if (confirmation) {
        document.getElementById('delete-form-' + taskId).submit();
    }
}