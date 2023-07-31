<?php 

class Dashboard_campaign_model {
    private $table = 'campaign';
    private $imageTable = 'image';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCampaign()
    {
        $query = "SELECT campaign.*, image.image AS image_filename 
              FROM $this->table AS campaign
              LEFT JOIN $this->imageTable AS image ON campaign.id = image.campaign_id";
    
        $this->db->query($query);
        $results = $this->db->resultSet();

        // Group events by ID and collect associated images
        $campaigns = [];
        foreach ($results as $row) {
            $campaign_id = $row['id'];

            if (!isset($campaigns[$campaign_id])) {
                // Create a new event entry
                $campaigns[$campaign_id] = [
                    'id' => $campaign_id,
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date'],
                    'target_amount' => $row['target_amount'],
                    'current_amount' => $this->getCurrentAmountByCampaignId($campaign_id),
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                // Add image filename to the event's images array
                $campaigns[$campaign_id]['images'][] = $row['image_filename'];
            }
        }

        return array_values($campaigns);
    }

    public function getCampaignById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function editCampaign($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataCampaign($data)
    {
        // Insert event data into the 'event' table
        $query = "INSERT INTO campaign (name, description, start_date, end_date, target_amount)
                VALUES (:name, :description, :start_date, :end_date,  :target_amount)";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('start_date', $data['start_date']);
        $this->db->bind('end_date', $data['end_date']);
        $this->db->bind('target_amount', $data['target_amount']);

        $this->db->execute();
        $campaign_id = $this->db->lastInsertId();

        // Handle image upload and insertion into the 'image' table
        if (isset($_FILES['images'])) {
            $images = $_FILES['images'];

            foreach ($images['tmp_name'] as $key => $tmp_name) {
                // Check if the uploaded file is valid
                if ($images['error'][$key] === UPLOAD_ERR_OK) {
                    // Retrieve the image details
                    $image_name = $images['name'][$key];
                    $image_type = $images['type'][$key];
                    $image_size = $images['size'][$key];
                    $image_tmp_name = $images['tmp_name'][$key];

                    // Specify the directory to store the uploaded images
                    $upload_dir = 'C:/xampp/htdocs/donasi/public/images/'; // Change the directory path as per your requirement

                    // Generate a unique filename for the image
                    $image_filename = uniqid() . '_' . $image_name;

                    // Move the uploaded image to the desired directory
                    move_uploaded_file($image_tmp_name, $upload_dir . $image_filename);

                    // Insert image details into the 'image' table
                    $query = "INSERT INTO $this->imageTable (campaign_id, image)
                            VALUES (:campaign_id, :image)";

                    $this->db->query($query);
                    $this->db->bind('campaign_id', $campaign_id);
                    $this->db->bind('image', $image_filename);
                    $this->db->execute();
                }
            }
        }

        return $this->db->rowCount();
    }



    public function hapusDataCampaign($id)
    {
        // Delete associated images from the 'image' table
        $query = "DELETE FROM $this->imageTable WHERE campaign_id = :campaign_id";
        
        $this->db->query($query);
        $this->db->bind('campaign_id', $id);

        $this->db->execute();

        // Delete event from the 'event' table
        $query = "DELETE FROM $this->table WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        

        return $this->db->rowCount();
    }


    public function ubahDataCampaign($data)
    {
        $query = "UPDATE campaign SET
                    name = :name,
                    description = :description,
                    start_date = :start_date,
                    end_date = :end_date,
                    target_amount = :target_amount
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('start_date', $data['start_date']);
        $this->db->bind('end_date', $data['end_date']);
        $this->db->bind('target_amount', $data['target_amount']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function cariDataCampaign()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM 'campaign' WHERE title LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function getLatestCampaign($limit = 3)
    {
        $query = "SELECT campaign.*, image.image AS image_filename 
                FROM $this->table AS campaign
                LEFT JOIN $this->imageTable AS image ON campaign.id = image.campaign_id
                ORDER BY campaign.end_date DESC 
                LIMIT :limit";

        $this->db->query($query);
        $this->db->bind('limit', $limit);
        $results = $this->db->resultSet();

        // Group campaigns by ID and collect associated images
        $campaigns = [];
        foreach ($results as $row) {
            $campaign_id = $row['id'];

            if (!isset($campaigns[$campaign_id])) {
                // Create a new campaign entry
                $campaigns[$campaign_id] = [
                    'id' => $campaign_id,
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date'],
                    'target_amount' => $row['target_amount'],
                    'images' => []
                ];
            }

            if (!empty($row['image_filename'])) {
                // Add image filename to the campaign's images array
                $campaigns[$campaign_id]['images'][] = $row['image_filename'];
            }
        }

        return array_values($campaigns);
    }

    public function getCurrentAmountByCampaignId($campaign_id)
    {
        $query = "SELECT SUM(amount) AS current_amount FROM donation WHERE campaign_id = :campaign_id";
        $this->db->query($query);
        $this->db->bind('campaign_id', $campaign_id);
        $result = $this->db->single();
        return $result['current_amount'] ?? 0;
    }


}