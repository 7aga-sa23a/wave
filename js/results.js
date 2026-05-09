// bn-geeb el data mn el local storage aw b-ndeha 0 lw msh mawgoda
const score = localStorage.getItem("quizScore") || 0;
const correct = localStorage.getItem("correctAnswers") || 0;
const total = localStorage.getItem("totalQuestions") || 0;

// bn-update el HTML elements bl values de
document.getElementById("quizScore").textContent = score + "%";
document.getElementById("questionsAnswered").textContent = `${correct}/${total}`;
document.getElementById("accuracyRate").textContent = score + "%";
