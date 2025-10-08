/*
  # Système de Gestion Académique - Schema Database

  ## Description
  Ce migration crée les tables nécessaires pour gérer les enseignants, étudiants et l'historique des actions dans le système de gestion académique.

  ## Nouvelles Tables
  
  ### 1. `enseignants`
  Table pour stocker les informations des enseignants
  - `id` (uuid, primary key) - Identifiant unique
  - `nom` (text) - Nom de famille
  - `prenom` (text) - Prénom
  - `mention` (text) - Mention/Spécialité
  - `diplome` (text) - Diplôme obtenu
  - `etablissement` (text) - Établissement d'origine
  - `cv_filename` (text, nullable) - Nom du fichier CV
  - `cv_url` (text, nullable) - URL du CV stocké
  - `created_at` (timestamptz) - Date de création
  - `updated_at` (timestamptz) - Date de modification

  ### 2. `etudiants`
  Table pour stocker les informations des étudiants
  - `id` (uuid, primary key) - Identifiant unique
  - `nom` (text) - Nom de famille
  - `prenom` (text) - Prénom
  - `niveau` (text) - Niveau d'étude (L1, L2, L3, M1, M2)
  - `mention` (text) - Mention/Spécialité
  - `matricule` (text, unique) - Numéro matricule unique
  - `photo_url` (text, nullable) - URL de la photo
  - `created_at` (timestamptz) - Date de création
  - `updated_at` (timestamptz) - Date de modification

  ### 3. `historique`
  Table pour stocker l'historique des actions
  - `id` (uuid, primary key) - Identifiant unique
  - `date` (date) - Date de l'action
  - `action` (text) - Type d'action (Inscription, Modification, Suppression)
  - `etudiant_id` (uuid, nullable) - Référence à l'étudiant concerné
  - `etudiant_nom` (text) - Nom complet de l'étudiant
  - `details` (text) - Détails de l'action
  - `created_at` (timestamptz) - Date de création

  ## Sécurité
  - Row Level Security (RLS) activé sur toutes les tables
  - Politiques d'accès pour les utilisateurs authentifiés
  - Les utilisateurs authentifiés peuvent lire, créer, modifier et supprimer les enregistrements

  ## Notes importantes
  - Les CV et photos sont stockés via upload et référencés par URL
  - Le matricule des étudiants est unique
  - L'historique conserve une trace de toutes les actions importantes
*/

-- Create enseignants table
CREATE TABLE IF NOT EXISTS enseignants (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  nom text NOT NULL,
  prenom text NOT NULL,
  mention text NOT NULL,
  diplome text NOT NULL,
  etablissement text NOT NULL,
  cv_filename text,
  cv_url text,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Create etudiants table
CREATE TABLE IF NOT EXISTS etudiants (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  nom text NOT NULL,
  prenom text NOT NULL,
  niveau text NOT NULL,
  mention text NOT NULL,
  matricule text UNIQUE NOT NULL,
  photo_url text,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Create historique table
CREATE TABLE IF NOT EXISTS historique (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  date date DEFAULT CURRENT_DATE,
  action text NOT NULL,
  etudiant_id uuid,
  etudiant_nom text NOT NULL,
  details text NOT NULL,
  created_at timestamptz DEFAULT now(),
  FOREIGN KEY (etudiant_id) REFERENCES etudiants(id) ON DELETE SET NULL
);

-- Enable Row Level Security
ALTER TABLE enseignants ENABLE ROW LEVEL SECURITY;
ALTER TABLE etudiants ENABLE ROW LEVEL SECURITY;
ALTER TABLE historique ENABLE ROW LEVEL SECURITY;

-- Create policies for enseignants
CREATE POLICY "Authenticated users can view enseignants"
  ON enseignants FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Authenticated users can insert enseignants"
  ON enseignants FOR INSERT
  TO authenticated
  WITH CHECK (true);

CREATE POLICY "Authenticated users can update enseignants"
  ON enseignants FOR UPDATE
  TO authenticated
  USING (true)
  WITH CHECK (true);

CREATE POLICY "Authenticated users can delete enseignants"
  ON enseignants FOR DELETE
  TO authenticated
  USING (true);

-- Create policies for etudiants
CREATE POLICY "Authenticated users can view etudiants"
  ON etudiants FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Authenticated users can insert etudiants"
  ON etudiants FOR INSERT
  TO authenticated
  WITH CHECK (true);

CREATE POLICY "Authenticated users can update etudiants"
  ON etudiants FOR UPDATE
  TO authenticated
  USING (true)
  WITH CHECK (true);

CREATE POLICY "Authenticated users can delete etudiants"
  ON etudiants FOR DELETE
  TO authenticated
  USING (true);

-- Create policies for historique
CREATE POLICY "Authenticated users can view historique"
  ON historique FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Authenticated users can insert historique"
  ON historique FOR INSERT
  TO authenticated
  WITH CHECK (true);

CREATE POLICY "Authenticated users can delete historique"
  ON historique FOR DELETE
  TO authenticated
  USING (true);

-- Create indexes for better performance
CREATE INDEX IF NOT EXISTS idx_enseignants_nom ON enseignants(nom);
CREATE INDEX IF NOT EXISTS idx_enseignants_prenom ON enseignants(prenom);
CREATE INDEX IF NOT EXISTS idx_etudiants_matricule ON etudiants(matricule);
CREATE INDEX IF NOT EXISTS idx_etudiants_nom ON etudiants(nom);
CREATE INDEX IF NOT EXISTS idx_historique_date ON historique(date DESC);
CREATE INDEX IF NOT EXISTS idx_historique_etudiant_id ON historique(etudiant_id);

-- Create function to update updated_at timestamp
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = now();
    RETURN NEW;
END;
$$ language 'plpgsql';

-- Create triggers for updated_at
DROP TRIGGER IF EXISTS update_enseignants_updated_at ON enseignants;
CREATE TRIGGER update_enseignants_updated_at
    BEFORE UPDATE ON enseignants
    FOR EACH ROW
    EXECUTE FUNCTION update_updated_at_column();

DROP TRIGGER IF EXISTS update_etudiants_updated_at ON etudiants;
CREATE TRIGGER update_etudiants_updated_at
    BEFORE UPDATE ON etudiants
    FOR EACH ROW
    EXECUTE FUNCTION update_updated_at_column();
