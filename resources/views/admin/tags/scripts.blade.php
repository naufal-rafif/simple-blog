<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script>
    const showModalDelete = document.getElementById('tableList')
    const closeModalDelete = document.getElementById('closeModalDelete')
    const tagName = document.getElementById('tagName')
    const tagColor = document.getElementById('tagColor')
    const tagBackground = document.getElementById('tagBackground')
    const changePreview = document.getElementById('changePreview')
    const tableList = document.getElementById('tbl_list')

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

    if(tableList){
        $(document).ready(function () {
            $('#tbl_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [
                    { data: 'name', name: 'name' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    }
    
</script>