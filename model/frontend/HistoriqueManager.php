<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

class HistoriqueManager
{
    private $supabase;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $this->supabase = \Supabase\CreateClient::createClient(
            $_ENV['SUPABASE_URL'],
            $_ENV['SUPABASE_KEY']
        );
    }

    public function getAllHistorique()
    {
        try {
            $response = $this->supabase
                ->from('historique')
                ->select('*')
                ->order('date', ['ascending' => false])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error getting historique: " . $e->getMessage());
            return [];
        }
    }

    public function createHistorique($data)
    {
        try {
            $response = $this->supabase
                ->from('historique')
                ->insert([
                    'date' => $data['date'] ?? date('Y-m-d'),
                    'action' => $data['action'],
                    'etudiant_id' => $data['etudiant_id'] ?? null,
                    'etudiant_nom' => $data['etudiant_nom'],
                    'details' => $data['details']
                ])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error creating historique: " . $e->getMessage());
            return null;
        }
    }

    public function deleteHistorique($id)
    {
        try {
            $response = $this->supabase
                ->from('historique')
                ->delete()
                ->eq('id', $id)
                ->execute();

            return true;
        } catch (Exception $e) {
            error_log("Error deleting historique: " . $e->getMessage());
            return false;
        }
    }

    public function getHistoriqueByEtudiant($etudiantId)
    {
        try {
            $response = $this->supabase
                ->from('historique')
                ->select('*')
                ->eq('etudiant_id', $etudiantId)
                ->order('date', ['ascending' => false])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error getting historique by etudiant: " . $e->getMessage());
            return [];
        }
    }
}
