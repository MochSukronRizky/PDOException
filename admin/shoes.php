
<?php
    include '../lib/koneksi.php';
    require_once '../lib/query.php';
?>
<div>
    <table class='table table-bordered table-responsive'>
        <tr>
            <th>#</th>
            <th>nama</th>
            <th>stok</th>
            <th>img</th>
            <th>keterangan</th>
            <th>jenis</th>
        </tr>
        <?php
            $query1 = "SELECT * FROM product";
            $records_per_page=3;
            $newQuery = $query1->paging($query1,$records_per_page);
            $query->dataView($newQuery);
        ?>
        <tr>
            <td colspan="7" align="center">
                <div class="pagination-wrap">
                    <?php $query->pagingLink($query1,$records_per_page); ?>
                </div>
            </td>
        </tr>
    </table>
</div>
