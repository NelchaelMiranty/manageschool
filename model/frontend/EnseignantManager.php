<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

class EnseignantManager
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

    public function getAllEnseignants()
    {
        try {
            $response = $this->supabase
                ->from('enseignants')
                ->select('*')
                ->order('created_at', ['ascending' => false])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error getting enseignants: " . $e->getMessage());
            return [];
        }
    }

    public function getEnseignant($id)
    {
        try {
            $response = $this->supabase
                ->from('enseignants')
                ->select('*')
                ->eq('id', $id)
                ->single()
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error getting enseignant: " . $e->getMessage());
            return null;
        }
    }

    public function createEnseignant($data)
    {
        try {
            $response = $this->supabase
                ->from('enseignants')
                ->insert([
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'mention' => $data['mention'],
                    'diplome' => $data['diplome'],
                    'etablissement' => $data['etablissement'],
                    'cv_filename' => $data['cv_filename'] ?? null,
                    'cv_url' => $data['cv_url'] ?? null
                ])
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error creating enseignant: " . $e->getMessage());
            return null;
        }
    }

    public function updateEnseignant($id, $data)
    {
        try {
            $response = $this->supabase
                ->from('enseignants')
                ->update([
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'mention' => $data['mention'],
                    'diplome' => $data['diplome'],
                    'etablissement' => $data['etablissement'],
                    'cv_filename' => $data['cv_filename'] ?? null,
                    'cv_url' => $data['cv_url'] ?? null
                ])
                ->eq('id', $id)
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error updating enseignant: " . $e->getMessage());
            return null;
        }
    }

    public function deleteEnseignant($id)
    {
        try {
            $response = $this->supabase
                ->from('enseignants')
                ->delete()
                ->eq('id', $id)
                ->execute();

            return true;
        } catch (Exception $e) {
            error_log("Error deleting enseignant: " . $e->getMessage());
            return false;
        }
    }

    public function searchEnseignants($searchTerm)
    {
        try {
            $response = $this->supabase
                ->from('enseignants')
                ->select('*')
                ->or("nom.ilike.%{$searchTerm}%,prenom.ilike.%{$searchTerm}%")
                ->execute();

            return $response->data;
        } catch (Exception $e) {
            error_log("Error searching enseignants: " . $e->getMessage());
            return [];
        }
    }
}
