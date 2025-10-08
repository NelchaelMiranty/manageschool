<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

class EtudiantManager
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

    public function getAllEtudiants()
    {
        try {
            $response = $this->supabase
                ->from('etudiants')
                ->select('*')
                ->order('created_at', ['ascending' => false])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error getting etudiants: " . $e->getMessage());
            return [];
        }
    }

    public function getEtudiant($id)
    {
        try {
            $response = $this->supabase
                ->from('etudiants')
                ->select('*')
                ->eq('id', $id)
                ->single()
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error getting etudiant: " . $e->getMessage());
            return null;
        }
    }

    public function createEtudiant($data)
    {
        try {
            $response = $this->supabase
                ->from('etudiants')
                ->insert([
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'niveau' => $data['niveau'],
                    'mention' => $data['mention'],
                    'matricule' => $data['matricule'],
                    'photo_url' => $data['photo_url'] ?? null
                ])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error creating etudiant: " . $e->getMessage());
            return null;
        }
    }

    public function updateEtudiant($id, $data)
    {
        try {
            $response = $this->supabase
                ->from('etudiants')
                ->update([
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'niveau' => $data['niveau'],
                    'mention' => $data['mention'],
                    'matricule' => $data['matricule'],
                    'photo_url' => $data['photo_url'] ?? null
                ])
                ->eq('id', $id)
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error updating etudiant: " . $e->getMessage());
            return null;
        }
    }

    public function deleteEtudiant($id)
    {
        try {
            $response = $this->supabase
                ->from('etudiants')
                ->delete()
                ->eq('id', $id)
                ->execute();

            return true;
        } catch (Exception $e) {
            error_log("Error deleting etudiant: " . $e->getMessage());
            return false;
        }
    }

    public function searchEtudiants($searchTerm)
    {
        try {
            $response = $this->supabase
                ->from('etudiants')
                ->select('*')
                ->or("nom.ilike.%{$searchTerm}%,prenom.ilike.%{$searchTerm}%,matricule.ilike.%{$searchTerm}%")
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error searching etudiants: " . $e->getMessage());
            return [];
        }
    }
}
