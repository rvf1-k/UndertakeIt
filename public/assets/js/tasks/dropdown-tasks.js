document.addEventListener("click", (e) => {
    console.log("hola");
    const button = e.target.closest(".task-toggle");
    
    const container = button.closest(".task-item");
    const content = container.querySelector(".task-content");
  
    content.classList.toggle("hidden");
});
