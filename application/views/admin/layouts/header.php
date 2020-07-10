<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="baseUrl" content="<?= base_url() ?>">

  <title><?= $_title_ ?></title>
  <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- new css -->
  <link rel="stylesheet" href="<?= base_url() ?>public/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/libs/jquery-scrollbar/jquery.scrollbar.min.css">
  <link href="<?= base_url() ?>public/libs/sweetalert/sweetalert.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url() ?>public/libs/select2/select2.min.css">
  <link href="<?= base_url(); ?>public/libs/toastr/dist/build/toastr.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>public/css/admin.app.min.css">
  <script src="<?= base_url() ?>public/libs/jquery/jquery.min.js"></script>

  <script src="<?= base_url() ?>public/vendors/vue.min.js"></script>

  <style>
    #listbox .bootstrap-duallistbox-container .form-control option {
      padding: 10px;
    }

    .dataTables_wrapper .dt-buttons a.dt-button {
      background-color: #00b0e4 !important;
    }
  </style>
</head>