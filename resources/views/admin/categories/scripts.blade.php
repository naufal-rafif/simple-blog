<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script>
    const showModalDelete = document.getElementById('tableList')
    const closeModalDelete = document.getElementById('closeModalDelete')
    const tableList = document.getElementById('tbl_list')
    // const submitButton = document.getElementById('submitButton')

    showModalDelete.addEventListener('click', (e) => {
        console.log()
        // console.log(e.target.parentElement.dataset.val)
        if (e.target.parentElement.classList[0] == 'btn_empty') {
            document.getElementById('modalDelete').classList.toggle('hidden')
            document.getElementById('modalDelete').classList.add('show')
            document.getElementById('modalDelete').classList.remove('hide')
            document.getElementById('formDelete').action = e.target.parentElement.dataset.val
        }
    })
    
    // submitButton.addEventListener('click', (e) => {
    //     // console.log('hai')
    //     document.getElementById('formDelete').submit()
    // })
    
    closeModalDelete.addEventListener('click', (e) => {
        // console.log(e.target.id)
        if (e.target.id == 'closeModalDelete' || e.target.id == 'closeButton') {
            document.getElementById('modalDelete').classList.remove('show')
            document.getElementById('modalDelete').classList.add('hide')
            setTimeout(function () { document.getElementById('modalDelete').classList.toggle('hidden') }, 500);
        }
    })

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