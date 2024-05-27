import "./bootstrap";
// import { Livewire } from 'livewire';


window.addEventListener("alert", (event) => {
   
    let data = event.detail;
    Swal.fire({
        icon: data[0].type,
        title: data[0].title,
        text: data[0].text,
      });
});


  

