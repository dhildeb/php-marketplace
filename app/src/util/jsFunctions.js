// sweet alerts
function notify(message){
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: message
  })

}

function toggleModal(modal){
  $('#'+modal).modal('toggle')
}

function changeRoute(route){
window.location = route
}

function toggleClass(id, styl, e){
    e.preventDefault();
    e.stopPropagation();
  document.getElementById(id).classList.toggle(styl)
}