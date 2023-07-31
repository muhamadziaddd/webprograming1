<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Campaign</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Campaign</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Daftar Campaign</h2>
                <a href="<?= BASEURL; ?>/DashboardCampaign/create" class="btn btn-primary float-right">Create Data</i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Target Amount</th>
                      <th>Image</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ( $data['campaign'] as $campaign ): 
                    ?>
                        <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?= $campaign['name']; ?></td>
                        <td><?= $campaign['description']; ?></td>
                        <td><?= $campaign['start_date']; ?></td>
                        <td><?= $campaign['end_date']; ?></td>
                        <td><?= $campaign['target_amount']; ?></td>
                          <?php if (!empty($campaign['images'])): ?>
                            <td>
                              <div class="image-gallery">
                                <?php foreach ($campaign['images'] as $image): ?>
                                  <img src="<?= BASEURL; ?>/images/<?= $image; ?>" alt="campaign Image" style=" max-width:30px;">
                                <?php endforeach; ?>
                              </div>
                            </td>
                          <?php endif; ?>
                        <td>
                        <div class="btn-group">
                            <a href="<?= BASEURL; ?>/DashboardCampaign/detail/<?= $campaign['id']; ?>" class="btn btn-primary float-right"><i class="fa fa-eye"></i></a>
                            <a href="<?= BASEURL; ?>/DashboardCampaign/edit/<?= $campaign['id']; ?>" class="btn btn-success float-right" ><i class="fa fa-pen"></i></a>
                            <a href="<?= BASEURL; ?>/DashboardCampaign/hapus/<?= $campaign['id']; ?>" class="btn btn-danger float-right" onclick="return confirm('yakin?');"><i class="fa fa-trash"></i></a>
                        </div>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>