// $(function() {

//     $('.tombolTambahDataDonasi').on('click', function() {
//       var campaignId = $(this).data('campaign-id');
//       console.log('Button clicked! Campaign ID:', campaignId);

//       // Reset form sebelum menampilkan modal
//       $('#formModalLabel').html('Donasi');
//       $('.modal-footer button[type=submit]').html('Donasi');
//       $('#name').val('');
//       $('#amount').val('');
//       $('#payment_method').val('');
//       $('#campaign_id').val(campaignId);
//       $('#id').val('');

//       // Tampilkan modal
//       $('#formModalEvent').modal('show');
//     });

//     // Submit form menggunakan AJAX
//     $('#donationForm').submit(function(event) {
//       event.preventDefault();
//       var formData = $(this).serialize();

//       $.ajax({
//         url: 'http://localhost/phpmvc/public/donasi/tambah', // Ganti dengan URL server-side yang sesuai
//         type: 'POST',
//         data: formData,
//         success: function(response) {
//           console.log('Donation success:', response);
//           alert('Donasi berhasil dikirim!');
//           $('#formModalEvent').modal('hide');
//           // Lakukan tindakan lain setelah donasi berhasil dikirim, jika diperlukan
//         },
//         error: function(error) {
//           console.error('Error sending donation:', error);
//           alert('Terjadi kesalahan saat mengirim donasi. Silakan coba lagi.');
//           // Lakukan tindakan lain jika ada kesalahan saat mengirim donasi
//         }
//       });
//     });
//   });
    
    
    
    // $('.tampilModalUbahEvent').on('click', function() {
        
    //     $('#formModalLabel').html('Ubah Data Event');
    //     $('.modal-footer button[type=submit]').html('Ubah Data');
    //     $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/event/ubah');

    //     const id = $(this).data('id');
        
    //     $.ajax({
    //         url: 'http://localhost/phpmvc/public/event/getubah',
    //         data: {id : id},
    //         method: 'post',
    //         dataType: 'json',
    //         success: function(data) {
    //             $('#title').val(data.title);
    //             $('#deskripsi').val(data.deskripsi);
    //             $('#venue').val(data.venue);
    //             $('#number_of_participants').val(data.number_of_participants);
    //             $('#id').val(data.id);
    //         }
    //     });
        
    // });