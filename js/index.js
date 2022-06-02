let modal = null
const focusableSelector = 'button,a,input,textarea'
let focusables = []




const openModal =  async function (e) {
    e.preventDefault()
    const target = e.target.getAttribute('href')
    if (target.startsWith('#')){
        modal = document.querySelector(target)
    }else{
        modal = await loadModal(target)
    }
    focusables = Array.from(modal.querySelectorAll(focusableSelector))
    previouslyFocusedElement = document.querySelector(':focus')
    modal.style.display =null
    focusables[0].focus()
    modal.removeAttribute('aria-hidden')
    modal.setAttribute('aria-modal', 'true')
    modal.addEventListener('click', closeModal)
    modal.querySelector('.js-modal-close').addEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop').addEventListener('click' , stopPropagation)
}

const closeModal = function (e) {
    if (modal === null) return
    e.preventDefault()
   
    modal.setAttribute('aria-hidden','true')
    modal.removeAttribute('aria-modal')
    modal.removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-close').removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop').removeEventListener('click' , stopPropagation)
    const hideModal = function() {
        modal.style.display = "none"
        modal.removeEventListener('animationend', hideModal)
        modal = null
    }
    modal.addEventListener('animationend', hideModal)
}

const stopPropagation = function(e){
    e.stopPropagation()
}

const loadModal =  async function (url) {
    const target = '#' + url.split('#')[1]
  const html = await fetch(url).then(response => response.text())
 const fragment = document.createRange().createContextualFragment(html)
  console.log(fragment)
}





document.querySelectorAll('.js-modal').forEach(a => {
    a.addEventListener('click',openModal)
})


window.addEventListener('keydown', function (e) {
    if (e.key === "Escape" || e.key === "esc") {
        closeModal(e)
    }
})