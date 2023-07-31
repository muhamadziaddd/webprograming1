<div class="container mt-5">
    <h2 class="mb-4">All Donations</h2>
    <div class="row">
      <!-- Example of a donation card (Replace with dynamic data from backend) -->
        <?php 
          foreach ( $data['campaign'] as $data ): 
        ?>
        <?php
            // Calculate the donation progress as a percentage
            $donation_progress = ($data['current_amount'] / $data['target_amount']) * 100;

            $formatted_progress = number_format($donation_progress, 0);
        ?>
        <div class="col-lg-4 mb-4 animated fadeInUp donation-card">
          <div class="card">
          <?php if (!empty($data['images'])): ?>
              <img src="<?= BASEURL; ?>/images/<?= ($data['images'][0]); ?>" alt="Campaign Image">
          <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= $data['name']; ?></h5>
              <p class="card-text"><?= $data['start_date']; ?> Sampai <?= $data['end_date']; ?></p>
              <p class="card-text">Rp. <?= $data['target_amount']; ?></p>
              <!-- <p class="card-text">Dana Yang terkumpul </p> -->
              <p class="card-text">
                    <?php
                    // Display the current donation amount and the target amount
                    echo "Dana Yang terkumpul <br>";
                    echo "Rp. " . $data['current_amount'] . " / Rp. " . $data['target_amount'];
                    ?>
               </p>
               <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?= $donation_progress; ?>%;" aria-valuenow="<?= $donation_progress; ?>" aria-valuemin="0" aria-valuemax="100"><?= $formatted_progress; ?>%</div>
                </div>
              <p class="card-text mt-1"><?= $data['description']; ?></p>
              <button type="button" class="btn btn-primary tombolTambahDataDonasi" data-bs-toggle="modal" data-bs-target="#formModalEvent" data-campaign-id="<?= $data['id']; ?>">
                Donasi 
                </button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

      <!-- Add more donation cards as needed -->
    </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="formModalEvent" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel"></h5>
      </div>
      <div class="modal-body">
        
        <form id="donationForm"  action="<?= BASEURL; ?>/donasi/tambah" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">
            <div class="form-group row mb-2">
                <input type="hidden" name="campaign_id" id="campaign_id" value="">
                <label for="name" class="col-sm-2 col-form-label">name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="amount" class="col-sm-2 col-form-label">amount</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-1 mt-2">
                        <label for="amount">Rp.</label> 
                        </div>
                        <div class="col-11">
                        <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="role" class="col-sm-2 col-form-label">Payment</label>
                <div class="col-sm-10">
                    <select class="form-control select2 select7" style="width: 100%;" name="payment_method">
                        <option value="BCA" selected="selected" data-image="<?= BASEURL; ?>/img/bca.png">BCA</option>
                        <option value="BRI" selected="selected" data-image="<?= BASEURL; ?>/img/bca.png">BRI</option>
                        <option value="Mandiri" selected="selected" data-image="<?= BASEURL; ?>/img/bca.png">Mandiri</option>
                    </select>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(function() {
    $('.tombolTambahDataDonasi').on('click', function() {
      var campaignId = $(this).data('campaign-id');
      console.log('Button clicked! Campaign ID:', campaignId);

      // Reset form sebelum menampilkan modal
      $('#formModalLabel').html('Donasi');
      $('.modal-footer button[type=submit]').html('Donasi');
      $('#name').val('');
      $('#amount').val('');
      $('#payment_method').val('');
      $('#campaign_id').val(campaignId);
      $('#id').val('');

      // Tampilkan modal
      $('#formModalEvent').modal('show');
    });

    // Submit form menggunakan AJAX
    $('#donationForm').submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Donation success:', response);
            // Show SweetAlert with QR code for payment
            Swal.fire({
            title: 'QR Code Payment',
            text: 'Please scan this QR code to make the payment',
            imageUrl: 'http://localhost/donasi/public/img/qr.png', // Replace with the URL to your QR code image
            imageWidth: 200, // Adjust the image width as needed
            imageHeight: 200, // Adjust the image height as needed
            imageAlt: 'QR Code',
            confirmButtonText: 'Close',
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
            customClass: 'swal2-modal-auto-height', // For custom height adjustment
            });

            // Set a timeout to simulate the payment processing (5 seconds in this example)
            setTimeout(function() {
            Swal.fire({
                title: 'Donation Success',
                text: 'Thank you for your donation!',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                $('#formModalEvent').modal('hide');
                // Lakukan tindakan lain setelah SweetAlert dikonfirmasi, jika diperlukan
                }
            });
            }, 10000); 
        },
        error: function(error) {
          console.error('Error sending donation:', error);
          alert('Terjadi kesalahan saat mengirim donasi. Silakan coba lagi.');
          // Lakukan tindakan lain jika ada kesalahan saat mengirim donasi
        }
      });
    });
  });
</script>