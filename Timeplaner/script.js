let chores = [
  {
    choresName: "Walk with the dog",
    image:
      "https://cdn.pixabay.com/photo/2023/07/15/08/43/labrador-8128379_1280.jpg",
    description:
      "Walking with Kaya, at least twice a day.",
    importance: 0,
    choresFinishes: false,
    location: "Vienna",
  },
  {
    choresName: "Hoopers training",
    image:
      "https://cdn.pixabay.com/photo/2019/10/25/18/34/dog-4577659_1280.jpg",
    description: "Weekly hoopers training with Kaya.",
    importance: 0,
    choresFinishes: false,
    location: "Breitenfurt",
  },
  {
    choresName: "Mrs. Sporty training",
    image:
      "https://cdn.pixabay.com/photo/2013/02/26/02/14/exercise-86200_1280.jpg",
    description: "3 times a week, Mrs. Sporty club.",
    importance: 0,
    choresFinishes: false,
    location: "Alt Erlaa",
  },
  {
    choresName: "Dinner with my sister",
    image:
      "https://cdn.pixabay.com/photo/2018/10/04/09/48/gedeckter-table-3723273_1280.jpg",
    description: "Dinner with sister Susanne as a birthday present.",
    importance: 0,
    choresFinishes: false,
    location: "Klosterneuburg",
  },
  {
    choresName: "Cleaning",
    image:
      "https://cdn.pixabay.com/photo/2014/12/17/16/54/clean-571679_1280.jpg",
    description: "Cleaning the whole apartment.",
    importance: 0,
    choresFinishes: false,
    location: "Liesing",
  },
  {
    choresName: "Diary",
    image:
      "https://cdn.pixabay.com/photo/2017/05/16/13/19/writing-2317766_1280.jpg",
    description: "Writing my diary every evening.",
    importance: 0,
    choresFinishes: false,
    location: "Liesing",
  },
  {
    choresName: "Codefactory course",
    image:
      "https://cdn.pixabay.com/photo/2020/05/30/18/05/desktop-5239850_1280.jpg",
    description: "Attend the course daily.",
    importance: 0,
    choresFinishes: false,
    location: "Vienna",
  },
  {
    choresName: "Laundry",
    image:
      "https://cdn.pixabay.com/photo/2015/02/01/16/54/clothespins-619845_1280.jpg",
    description: "Making laundry for my family.",
    importance: 0,
    choresFinishes: false,
    location: "Liesing",
  },
  {
    choresName: "Shopping",
    image:
      "https://cdn.pixabay.com/photo/2021/08/17/16/54/vegetables-6553603_1280.jpg",
    description: "Grocery shopping.",
    importance: 0,
    choresFinishes: false,
    location: "Vienna",
  },
  {
    choresName: "Prework",
    image:
      "https://cdn.pixabay.com/photo/2018/01/17/07/06/laptop-3087585_960_720.jpg",
    description: "Daily prework for course.",
    importance: 0,
    choresFinishes: false,
    location: "Vienna",
  },
  {
    choresName: "Garden",
    image:
      "https://cdn.pixabay.com/photo/2022/10/14/22/21/pruning-7522188_1280.jpg",
    description: "Weekly gardening.",
    importance: 0,
    choresFinishes: false,
    location: "Liesing",
  },
  {
    choresName: "Parents visit",
    image:
      "https://cdn.pixabay.com/photo/2020/01/25/02/11/watercolour-4791614_1280.jpg",
    description: "Visit parents twice a week.",
    importance: 0,
    choresFinishes: false,
    location: "Vienna",
  },
];
// console.log(chores);

function displayCards(){
    for (let item of chores) {
        let result = document.getElementById("result");
        result.innerHTML += `
          <div>
              <div class="card my-3 mx-auto w-75">
              <div class="card-header fw-bold">
                  Tasks
              </div>
              <img src="${item.image}" class="card-img-top card-img" alt="${item.image}">
              <div class="card-body">
              <h5 class="card-title fs-5">${item.choresName}</h5>
              <p class="card-text">${item.description}</p>
              </div>
              <div class="card-footer text-body-secondary">
                <p class="card-text pb-1"><i class="fa-solid fa-triangle-exclamation"></i> Priority level: <span class="bg-success fs-5 fw-bold text-light priorNum">${item.importance}</span></p>
                <button class="btn btn-outline-secondary priorBtns"><i class="fa-sharp-duotone fa-solid fa-check"></i> Priority</button>
              </div>
            </div>
          </div>
          `;
      }
}
displayCards();

function increasePriority(){
    let priorBtns = document.querySelectorAll(".priorBtns");
    priorBtns.forEach((btn, index) => {
        btn.addEventListener("click", function(){
            if (chores[index].importance < 5){
                chores[index].importance ++;
                document.querySelectorAll(".priorNum")[index].innerHTML = chores[index].importance;
                changePrioColor(index);
                // console.log(chores[index]);
            }   
    });             
});
}
increasePriority();

function changePrioColor(index){
    if (chores[index].importance <= 1){
        document.querySelectorAll(".priorNum")[index].classList.replace("bg-danger", "bg-success");
    }
    else if (chores[index].importance <= 3){
        document.querySelectorAll(".priorNum")[index].classList.replace("bg-success", "bg-warning");
    } else {
        document.querySelectorAll(".priorNum")[index].classList.replace("bg-warning", "bg-danger");
    } 
}

let btnSort = document.getElementsByClassName("btnSort");
console.log(btnSort);
btnSort[0].addEventListener("click", sortArray);

function sortArray(){
  // chores.sort((a,b) => b.importance - a.importance);
  chores.sort((a,b) => a.importance - b.importance);
  console.log(chores);
  let result = document.getElementById("result");
  result.innerHTML = "";
  displayCards();
  increasePriority();
};
