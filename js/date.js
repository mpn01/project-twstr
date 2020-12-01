const todaysDate = new Date();
const day = todaysDate.getDate();
const month = todaysDate.getMonth()+1;
const year = todaysDate.getFullYear();

console.log(day+"."+month+"."+year);
