      </div>

      <!-- FOOTER -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; My Website</span>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- BUTTON SCROLL TOP -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- SBADMIN -->
  <script src="<?php echo base_url('assets/admin/js/sb-admin-2.min.js');?>"></script>

  <!-- SCRIPT / STYLE YANG BISA DI MASUKAN KE BAWAH SETELAH SCRIPT DILOAD -->
  <!-- VIVUS ANIMATION -->
  <script>
      new Vivus('svg-loading', {
        file: "<?php echo base_url('assets/images/svg-loading.svg');?>",
        type: 'oneByOne',
      });
  </script>

  <!-- LOADING FADEOUT -->
  <script>
      $("document").ready(function(){
        $("#loader-page").fadeOut(2000);
      });
  </script>

  <!-- MOMENT SET LOCALE -->
  <script>
    moment.locale('id');
  </script>

  <!-- JIKA ADA SESSION SUCCESS DARI SERVER -->
  <?php 
    if(!empty($this->session->flashdata("success"))){
      ?>
      <script>
      toastr.success(
        "<?php echo $this->session->flashdata('success')['text'];?>",
        "<?php echo $this->session->flashdata('success')['title'];?>",
      );
      </script>
      <?php
    }
  ?>


    <!-- JIKA ADA SESSION ERROR DARI SERVER -->   
  <?php 
    if(!empty($this->session->flashdata("error"))){
      ?>
      <script>
      toastr.error(
        "<?php echo $this->session->flashdata('error')['text'];?>",
        "<?php echo $this->session->flashdata('error')['title'];?>",
      );
      </script>
      <?php
    }
  ?>     

  <!-- SWITCHE SETUP -->
  <script>
      var elems = Array
        .prototype
        .slice
        .call(document.querySelectorAll('input[data-plugin=switchery]'));

      elems.forEach(function(html) {
         var switchery = new Switchery(html);
      });
  </script>
</body>
</html>