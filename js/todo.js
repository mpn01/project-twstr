const tasks = [...document.querySelectorAll('#todo_main_task')];

console.log(tasks);

// tasks.forEach(task => task.addEventListener('click', e => {
//     tasks.forEach(task => {

//     })
// }))

function taskDone() {
    taskContainer.style.display = "none";
}