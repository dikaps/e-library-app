<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2021 &copy; Mazer</p>
        </div>
    </div>
</footer>
</div>
</div>
</div>

<script src="<?= base_url(); ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(); ?>assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="<?= base_url(); ?>assets/vendors/toastify/toastify.js"></script>

<script>
    // Simple Datatable
    let table1 = document.querySelector("#table1");
    let dataTable = new simpleDatatables.DataTable(table1);

    let table2 = document.querySelector("#table2");
    let dataTable2 = new simpleDatatables.DataTable(table2);
</script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url(); ?>assets/js/app.js"></script>
</body>

</html>