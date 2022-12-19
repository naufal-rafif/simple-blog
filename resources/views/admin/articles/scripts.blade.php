<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script>
    const saveAsDraft = document.getElementById('saveDraft')
    const saveAsPublication = document.getElementById('savePublication')
    const showModalDelete = document.getElementById('tableList')
    const closeModalDelete = document.getElementById('closeModalDelete')
    const checkRecovery = document.getElementById('checkRecovery')
    const imageChange = document.getElementById('imageComponent')
    
    if(saveAsDraft){
        saveAsDraft.addEventListener('click', (e)=>{
            const inputTags = document.getElementById('tagList').querySelectorAll('.relative > p')
            var showTags = ''
            for(var i = 0; i < inputTags.length; i++) {
                showTags = showTags + ',' + inputTags[i].dataset.id ;
            }
            document.getElementById('tagOutput').value = showTags.substr(1);
            document.getElementById('statusArticle').value = 0
            if(document.getElementById('tagOutput').value != ''){
                document.getElementById('formUpload').action = e.target.dataset.action
                    document.getElementById('formUpload').submit();
            } else {
                document.getElementById('tagError').innerHTML = 'tag tidak boleh kosong silahkan diisi terlebih dahulu'
            }
        })
        saveAsPublication.addEventListener('click', (e)=>{
            const inputTags = document.getElementById('tagList').querySelectorAll('.relative > p')
            var showTags = ''
            for(var i = 0; i < inputTags.length; i++) {
                showTags = showTags + ',' + inputTags[i].dataset.id ;
            }
            document.getElementById('tagOutput').value = showTags.substr(1);
            document.getElementById('statusArticle').value = 1
            if(document.getElementById('tagOutput').value != ''){
                document.getElementById('formUpload').action = e.target.dataset.action
                document.getElementById('formUpload').target = ''
                document.getElementById('formUpload').submit();
            } else {
                document.getElementById('tagError').innerHTML = 'tag tidak boleh kosong silahkan diisi terlebih dahulu'
            }
        })

        tinymce.init({
        setup : function(ed) {
        ed.on('keydown', function(event) {
            if (event.keyCode == 9) { // tab pressed
                ed.execCommand('mceInsertContent', false, '&emsp;&emsp;'); // inserts tab
                event.preventDefault();
                return false;
            }
            if (event.keyCode == 32) { // space bar
                if (event.shiftKey) {
                    ed.execCommand('mceInsertContent', false, '&hairsp;'); // inserts small space
                    event.preventDefault();
                    return false;
                }
            }
        });
        },
        selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: [
            'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
        });

        document.getElementById('tagList').addEventListener('click', (e) => {
            if(e.target.classList[0] == 'relative'){
                e.target.remove()
            } else if(e.target.classList[0] == 'py-2' || e.target.classList[0] == 'bx'){
                e.target.parentElement.remove()
            }
        })

        document.getElementById('tagValue').addEventListener('input', (e) => {
            document.getElementById('tagList').innerHTML += `
            <div class="relative w-full">
                <p class="py-2 px-2 rounded border-1 bg-gray-200 px-2 mb-2" data-id="${e.target.value}">${e.target.options[e.target.selectedIndex].text}</p>
                <span class="bx bx-x absolute right-0 top-0 text-xl font-bold p-2 cursor-pointer"></span>
            </div>`
        })
    }

    if(showModalDelete){
        showModalDelete.addEventListener('click', (e) => {
            if (e.target.parentElement.classList[0] == 'btn_empty') {
                document.getElementById('warningText').innerHTML = e.target.parentElement.dataset.message
                document.getElementById('modalDelete').classList.toggle('hidden')
                document.getElementById('modalDelete').classList.add('show')
                if(e.target.parentElement.dataset.action === 'destroy'){
                    document.getElementById('deleteMethod').innerHTML = '<input type="hidden" name="_method" value="DELETE">'
                }
                document.getElementById('modalDelete').classList.remove('hide')
                document.getElementById('formDelete').action = e.target.parentElement.dataset.val
            } else if (e.target.parentElement.classList[0] == 'btn_recover') {
                document.getElementById('modalDelete').classList.toggle('hidden')
                document.getElementById('modalDelete').classList.add('show')
                document.getElementById('deleteMethod').innerHTML = ''
                document.getElementById('modalDelete').classList.remove('hide')
                document.getElementById('formDelete').action = e.target.parentElement.dataset.val
                document.getElementById('warningText').innerHTML = e.target.parentElement.dataset.message
            }
        })
        
        closeModalDelete.addEventListener('click', (e) => {
            if (e.target.id == 'closeModalDelete' || e.target.id == 'closeButton') {
                document.getElementById('modalDelete').classList.remove('show')
                document.getElementById('modalDelete').classList.add('hide')
                setTimeout(function () { document.getElementById('modalDelete').classList.toggle('hidden') }, 500);
            }
        })

        document.getElementById('checkDelete').addEventListener('click', ()=>{
            const checkbox = document.getElementsByClassName("checkbox");
            let checkValue = ''
            for(i=0;i<checkbox.length;i++){
                if(checkbox[i].checked == true){
                    checkValue += checkbox[i].dataset.id + ','
                }
            }
            document.getElementById('modalDelete').classList.toggle('hidden')
            document.getElementById('modalDelete').classList.add('show')
            document.getElementById('modalDelete').classList.remove('hide')
            document.getElementById('warningText').innerHTML = document.getElementById('checkDelete').dataset.message
            document.getElementById('checkDelete').dataset.val
            document.querySelector('#formDelete > #ids').value = checkValue.slice(0, -1)
            document.getElementById('formDelete').action = document.getElementById('checkDelete').dataset.val
        })
        
    }

    if(checkRecovery){
        checkRecovery.addEventListener('click', ()=>{
            const checkbox = document.getElementsByClassName("checkbox");
            let checkValue = ''
            for(i=0;i<checkbox.length;i++){
                if(checkbox[i].checked == true){
                    checkValue += checkbox[i].dataset.id + ','
                }
            }
            document.getElementById('modalSosmed').classList.toggle('hidden')
            document.getElementById('modalSosmed').classList.add('show')
            document.getElementById('modalSosmed').classList.remove('hide')
            document.getElementById('deleteMethod').innerHTML = ''
            document.getElementById('warningText').innerHTML = checkRecovery.dataset.message
            checkRecovery.dataset.val
            document.querySelector('#formDelete > #ids').value = checkValue.slice(0, -1)
            document.getElementById('formDelete').action = checkRecovery.dataset.val
        })
    }
    
    const checkBoxes = (e) => {
        const checkbox = document.getElementsByClassName("checkbox");
        let checkValue = ''
        let lengthChecked = 0
        let lengthUnchecked = 0
        for(i=0;i<checkbox.length;i++){
            if(checkbox[i].checked == true){
                checkValue += checkbox[i].dataset.id + ','
                lengthChecked = lengthChecked + 1
            } else {
                lengthUnchecked = lengthUnchecked + 1
            }
        }
        if(lengthChecked == 0){
            document.getElementById('checkboxEvent').checked = false
            if(checkRecovery){
                document.getElementById('separator').classList.add('hidden')
                document.getElementById('checkRecovery').classList.add('hidden')
            }
            document.getElementById('checkDelete').classList.add('hidden')
        } else {
            if(checkRecovery){
                document.getElementById('separator').classList.remove('hidden')
                document.getElementById('checkRecovery').classList.remove('hidden')
            }
            document.getElementById('checkDelete').classList.remove('hidden')
        }
    }

    if(imageChange){
        imageChange.addEventListener('change', (e) => {
            const [file] = e.target.files
            document.getElementById('changeImage').src = URL.createObjectURL(file)
        })
    }
    
</script>