<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ADMIN - Food Ordering System Gapakelama</title>
  <!-- Bootstrap core CSS-->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?= base_url() ?>assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <!-- Load Data-->
    <?php
		$jumlahMakanan = $listMakanan->num_rows();?>

<?php include 'template/nav_header.php'; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- SUB TITLE-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">MENU</li>
        <li class="breadcrumb-item active">Daftar Makanan</li>
      </ol>
    <!-- CONTENT AREA -->
      <div class="row">
        <div class="col-12">
          <h1>Daftar Menu Makanan</h1>
          <div class="py-2">
            <?php
                $this->load->library('form_validation');
                echo validation_errors("<div class='alert alert-danger'>","</div>"); ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMakanan">Tambah Menu Makanan</button>
          </div>
          <!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> List Makanan</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Id Makanan</th>
                      <th>Nama Makanan</th>
                      <th>Harga</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Id Makanan</th>
                      <th>Nama Makanan</th>
                      <th>Harga</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php
				if($jumlahMakanan > 0){
				$i = 1;
        header('Content-type: image/jpeg'); 
				foreach ($listMakanan->result_array() as $row){
				?>
				<tr>
        	<td><?= $i++ ?></td>
            <td><?= $row->id_makanan ?></td>
            <td><?= $row->nama_makanan ?></td>
            <td>Rp.<?= $row->harga_makanan ?></td>
            <td><img src="<?php echo $row->image_makanan ?>"></td>
            <td>
              <button id="viewImage" type="button" class="btn btn-info" data-toggle="modal" data-target="#viewimagemodal" textcolor="#ffffff" data-id="<?= $row->id_makanan ?>"><i class="fa fa-image"></i></button>
            	<button type="button" class="edit-data btn btn-warning edit-data" data-toggle="modal" data-id="<?= $row->id_makanan ?>" data-nama="<?= $row->nama_makanan ?>" data-harga="<?= $row->harga_makanan ?>" data-target="#editMakanan" textcolor="#ffffff"><i class="fa fa-edit"></i></button>
              <a href="<?= base_url() ?>index.php/dashboard_admin/hapus_makananDb/<?= $row->id_makanan ?>"><button class="btn btn-danger" onClick="return doconfirm();"><i class="fa fa-trash-o"></i></button></a>
            </td>
         </tr>
         <?php
				}
					?>
                  </tbody>
                </table>
               <?php
                    }
                ?>
              </div>
            <MAMji  �����������������������������������������������������������������Ǫ��ǻ�������˪����������
�ʨ�ʺ������ʫ�����˺������ʺ��
˹Ⱥ�              �y     ���     ��    ��� � ˠ���� ����������w � ������������ ����������� �
����� � ���  �        Q��j�A�:�&�0%:)��J��⤲b^����ts�4�K�Q���Md쪽��v7�(�^W��hDN��Z8`�o&����r5>j�������E�y2E����c��D�P�p�C��uu�a�U���Z�g�V"N5���Uɩ��VLEn"S�+NTpaul(Z�� l�|��WcR�M���J�)�Ǘ�,e{���֘'Rq^��Q����S 	.� y���Ձ.zI1E���} �U�S��]�E;@�n2����zԃ+\XFT2����� S,���p�.Ed�L�x�& $;dtP�+@��I"�� ��~�����&�ũ�(�|�e~�\pa=Ejǵ	��Ep]6E�˸�*�"*�����bU�R�c�`K��\�ݒ)\9�%�w)y��|n ��K��\�����2��P�BW�R�
��.���Hb�aK�i$'��"ಠ�Wi�:l�F=1��p -����z��+2m[�"�`�+�r��24�d-�R�c����H�.�;�:���� �V5  /�I"�5��� �.On"���[��5`�҃	�t!5����. tC�\��`h���Œ���\C����HWߤ��{� �ծz���~Po�:A�T7.t}bL��]�������i��WԟEy7^,��A���Ezz:'���<>ʘ=v>���Р@���@rv@�z~� ��@0R���60��S�� 2љ�ٮ�� @dh`�lp� 
9;��=?� AQ �)J��8*	R ��\ �����@���@� �A�`@
�R) N��
KL;� �`� P68p������ �� (���S@� ���sO�Ѐ��D tx`�~� `�"(���yYmFp�B*� �\E�Ё�)�PA��؄����e"��@dv@�|��@
�Tp����� �� ����0�M��������(�� �����=�9�sA����Z���Nw�/��8��	oh�̴E�AɢpEx]�7�4cB���؃�+D��0Hfi���� �!�H�P
D&H�-a�lP{�{ s������BЕ7�"*Ez3=���HU��"����VzX"���)��Hj��E�2{X"���,R5:�"R�:,"���)M�H��"�M5j����d��`hp�	�3��z�8��xY�=^\���G	b2�069p�;=��@Q �)	Nm�d�A4f@�jx�|�� 
�C0 A)��@A**12 	b2�046PpQ��)�J��&E�[�X�����\��P�8�` 0\���8�q@�@���ܸ̀0�܃���s�r���ـ��   7�n� 8 q���������߃���H�<p�>�5~r#�"4�B�t�����v�a�ѰXȰƬ!av%=�!� o˿;*�8��9�]�G\B���&
�m1 �������� ��:u`�@� �`�k��@6 mAۃ�y�F� �A����`3�=�`e8��IE���hX�}�  ��(��@S�� ��x0�M��������(�� ���F�`�"(���&H�#�L�h���� ��D t|` �R0�
LTp�u�F<m;=��?'u<~:t;���Z��:������x����m�� ��`@=\?��B�y^z�'x�07`s�8pJM2�046Pp8Ё�����(���
�T@�*����᭦�DEG��s��=�5�D�$x�bX^0����BT����(��1X���� m ��,4�x��� 0
�YVSF�E�Ѐ@���@rv@�z~� ��@��BD00�)P��Q��&���@���@rv@�z~� ��@0R�Lp
T�� `�  35@`7Q�����  ��(��@S�� ��/�"��>�"i°H�d3X,R)�T��E"u��a��D:X,R����E"���a�H��X�RB(,��j�E�*PaX�[Lb �	240P68p������ �� (���S@� ���2� 	b2�046Pp8Ё�� !�6C�o�ࡁ�c��J@�ߠ}4C� 2�&`2(M���T�'�<AP�7`o�߃��9xs��ҁ��(a!�`�j��y(1���"�V0�P� /�k�ʠ.����/��t��x�$h�1��yz;�/��'芁���08 q�� �|�o�L�5`���
p9 �<>�0�)P�6�D)�^ۀmj�@\����8pz�z�r��_�g�8Ih��4��O�@�2�k����2ꏝ�c��0�`f��X�C3�8�!B��F�`H�h0�lv@ ��`K�"�xp� 
�R0 �);���?������RN�g
/�EH鿰)za��8aX��
�"Rv1,E���X�*p�E� ��EB��f@`	xcH ���L�
�H�����G��;��Jj�N�E�H��H�۰��N���I��R�=,���a��a���H���E�ɇ,R�:�"R�:,"���,R�0�l�	F���`C95@`b���������@�A�ʃك���͂䅽B�a��^f��7�o�����<d �AL��9�s��A����(H�AӃ�V
��+*@��iYe�~�@��.h �:�u��~W��3�x ;Q+`���w�6�mЛ� ��z�Br,�;��ၣt�A��Ђ�p����<�>Ȁ"��1�@d��M�#,R�8�"R�=,�b��~����+��o	] �Y�|-`s&[���hh�#)�OQXSf�A�h؀��� ��h��@0�R* 1 (�Ԁ�Er`�z��Uɵ2�1`F�1�)J��8*	RJ� lp� 
�p����U1��ԾK`��pb �	2{@|�|~`>�>X:hT�:�&`�`S�&�#�]��;�+�7��Dz�U��(������>ޮ�9��� �������� A�`p
8H�s��� �Y���k��갡��!�`� ہ�6�8r�� ��~o<��A�� ^T-��$�M@HG���n� ��_b�hDt�`[T�y� `>�6�0��@���`8�pA�^p� �Uu݈�c o��͝m�HT��H�ڰ���H����>aX��n(O�I���T��Hm��O���[4��ǽǀb9�F!�Hn�[��bV�E�8`i0�c&2�04�'@"�;c�#.
������-1�� ���  k��3�(�A�.r�4$FRI�[p��9 Ĳ@k�������&�s&�Le�����@��J�p
T��<<R3B]�C�'
�
�H䰋�Q�ImF�(��BH�!��VH���q�!) N��
�TDb@���P9s����`ρ�F��>@;p��r� ��Wm�-�"c;��=?� A!���=���)��"�pXE
��� �)ra����ttXEJȇ,R�:�"R�>,���aEi`C����c���>�O����f9
.��҇�Pj����1�����#�bd
�� ��(��k�`����C��ҙ���0�6 q��a�D��q�҂�0Z07H�>�7�o����A�$E�h@GMd `	h�=��@M���<��L���"��T�9;��=?�(f�	 )A^Qd8
��D��@�̂Qs:�| u�R`�-���I-�t�Ǔ��-*O%�"<b�Rdܣ�Q)A��
��ؠ�(���
H6P��@����M����D�>V:@r�'�G�ղ����^�ȾjȾ�j���	�}@qo�d� 6�y�m���8pp �ǁ�$T �d��<j{��`l��=xYC�P9��~� �#P��^�%@/��t�1����h��7@p�����4��҅�H��_�a�r`p���0��w��H�\�}��X���� m ��b�a��b�H�p#9����퇎F|3 Y01�z�z�s���A�R�Z��M���@��
6^�'�σ�.�,���cȎ(��c��$yDǼ�;��G���D�dF	3Z +�Q�"V8g���h��jR�n� vz����h�|�� ��+)�ˢ���g��C�p8�HeB�X���J�с����4o�8�y�� ����uI��ڌ��z�a?�C�E�7�wpX�`��8x)�22��`��L�Ab�E���qY�Z(*���@��-F�����l6m@� |���7�oe��q�>�:0}�u ���G�L�bJ
)�I����R:�)oʍR�hm7�ڤ���۲�2/1�I3�l��jڧϘܴ�t���s+�I���M����[��h�W�[�U�^3�OT�d���G�ߊ�V{�)���ݘuv`�	,`'g:`A$���!b�{���NZ��vS�1<YP�t3V��� $(,�(�s`�Yl`h���� h<X�P�Fe��6,�T��)��	�X	�a�OZ�?��`ɽO�h�ؠoM����0]� J�0+�`��n���d�v�P0��ra&��wy�e��_Zc�ϓ�h�5r`^�z��?����w/"%Y��T4!��W��S��1˿F`��}�-7`���F5��
La�`c��ǖ\Y�f�`w�{�cy�r=�I��� d\�!����`������paO��!.mf�v�e`�0K*c�'q���7a}B+`n��Y�O؜;������UPDL3�%|��`߮� �)�$��XTn�^*���_%b9�1\���d�)��}��f�i�!8c7�[*\2Tba|Y~Fj)�~`�I	��,��e�����<������#b�'�h,��ָ��O.L C�s-	�QA�f�X5����h��F,�kg��aP�@x�Y�k�$av����`@2�[jp��Fi�wť>!d��,���Q�b�g���ƔO�}ɗ7h��q�R�NM3h:Tn��fb�}rƙc6�
���ssV񮹀WG��� ���˩	����%~�vz|�|R��D��Io&��6yZ�_ҏc9���.|L����G�sNDL��DIէ�KD����<�>iv��5k-2�<Qkc��nK���>�2���:C�M�4�.Ca�R|���w�{�_"Z��b_��-�'Ik��z2�� '�D3ڿ�Z2E�DU3�bU0qz�JD�jL�mL~b                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          