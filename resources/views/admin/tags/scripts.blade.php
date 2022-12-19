
<script>
    const showModalDelete = document.getElementById('tableList')
    const closeModalDelete = document.getElementById('closeModalDelete')
    const tagName = document.getElementById('tagName')
    const tagColor = document.getElementById('tagColor')
    const tagBackground = document.getElementById('tagBackground')
    const changePreview = document.getElementById('changePreview')

    if(showModalDelete){
        showModalDelete.addEventListener('click', (e) => {
            if (e.target.parentElement.classList[0] == 'btn_empty') {
                document.getElementById('modalDelete').classList.toggle('hidden')
                document.getElementById('modalDelete').classList.add('show')
                document.getElementById('modalDelete').classList.remove('hide')
                document.getElementById('formDelete').action = e.target.parentElement.dataset.val
            }
        })
        
        closeModalDelete.addEventListener('click', (e) => {
            if (e.target.id == 'closeModalDelete' || e.target.id == 'closeButton') {
                document.getElementById('modalDelete').classList.remove('show')
                document.getElementById('modalDelete').classList.add('hide')
                setTimeout(function () { document.getElementById('modalDelete').classList.toggle('hidden') }, 500);
            }
        })
    }

    if(changePreview){
        tagName.addEventListener('input', ()=> {
            changePreview.innerHTML = tagName.value
        })
        tagColor.addEventListener('input', ()=> {
            changePreview.style.color = tagColor.value
        })
        tagBackground.addEventListener('input', ()=> {
            changePreview.style.background = tagBackground.value
        })
    }
    
</script>