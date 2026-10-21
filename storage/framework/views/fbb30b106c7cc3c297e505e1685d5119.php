<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet">
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script
>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-3">
<h2>Transactions</h2>
<a href="<?php echo e(url('/transactions/create')); ?>"><button type="button" class="btn btn-success btn-sm"
>Tambah</button></a>
<table class="table table-striped">
<thead>
<tr>
<th>Aksi</th>
<th>ID</th>
<th>Kode</th>
<th>Tanggal</th>
<th>Total</th>
</tr>
</thead>
<tbody id="TransactionTableBody">
<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td>
<a href="<?php echo e(url('/transactions/show/'. $transaction->id)); ?>" class="btn btn-warning btnsm">View</a>
</td>
<td><?php echo e($transaction->id); ?></td>
<td><?php echo e($transaction->invoice_number); ?></td>
<td><?php echo e($transaction->transaction_date); ?></td>
<td>Rp <?php echo e($transaction->total_amount); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
</body>
</html><?php /**PATH C:\laragon\www\latihan05\resources\views/transactions/index.blade.php ENDPATH**/ ?>