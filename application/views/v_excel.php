

<table border="1" width="100%">
    <thead>
        <tr class="">
            <th> No </th>
            <th> Nim </th>
            <th> Nama </th>
            <th> Jurusan </th>
            <th> Fakultas </th>
            <th> Cabang </th>
            <th> Jenis </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1; 
            foreach ($peserta->result() as $p) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $p->nim; ?></td>
            <td><?php echo $p->nama; ?></td>
            <td><?php echo $p->jurusan; ?></td>
            <td><?php echo $p->fakultas; ?></td>
            <td><?php echo $p->nama_cabang; ?></td>
            <td><?php echo $p->jenis; ?></td>
        </tr>
        <?php
            }
         ?>
    </tbody>
</table>
