




let modal = null
const focusableSelector = 'button,a,input,textarea'
let focusables = []




const openModal =  async function (e) {

    e.preventDefault()
    const target = document.getElementById(e.target.id).parentNode.getAttribute('href')
    if (target.startsWith('#')){
      //  modal = await loadModal(target)
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
    const exitingModal = document.querySelector(target)
    if (exitingModal !== null) return exitingModal
  const html = await fetch(url).then(response => response.text())
 const element = document.createRange().createContextualFragment(html).querySelector(target)
 if (element === null) throw `l'élément ${target} n'a pas été trouver dans la page ${url}`
 document.body.append(element)
 return element

  
}





document.querySelectorAll('.js-modal').forEach(a => {
    a.addEventListener('click',openModal)
})


window.addEventListener('keydown', function (e) {
    if (e.key === "Escape" || e.key === "esc") {
        closeModal(e)
    }
})

