<?php
    /* Authors :    Tayfun Ozturk
                    Julien Frillici
                    Bilge Ekinci
                    05-2018 / AppliSynth - Junior Entreprise
    Classe DAO Convention*/


class DaoConvention{
    
    #attributs
    private $bdd;
    private $hote;
    private $UserName;
    private $Password;
    
    #constructeur
    public function __construct($base, $hote, $UserName, $Password){
        try{
            $this->hote=$hote;
            $this->UserName=$UserName;
            $this->Password=$Password;
            $this->bdd = new PDO('mysql:host='.$hote.';dbname='.$base.';charset=utf8', $UserName, $Password);
        }catch (Exception $e){
            die('Erreur :' . $e->getMessage());
        }
    }
    
    public function insertTabConvention($DtoConvention){
        
        $requete = 'INSERT INTO convention(NomProjet, DateDebut, DateFin, MontantHT,
                             MontantTTC, Acompte, TVA; Signature, Commentaire) values(:t_NomProjet,:t_DateDebut,:t_DateFin, :t_MontantHT, :t_MontantTTC, :t_Acompte, :t_TVA, :t_Signature, :t_Commentaire);';
        
        $req = $this->bdd->prepare($requete);
        $req->execute( array(
            't_NomProjet' => $DtoConvention->getNomProjet(),
            't_DateDebut' => $DtoConvention->getDateDebut(),
            't_DateFin' => $DtoConvention->getDateFin(),
            't_MontantHT' => $DtoConvention->getMontantHT(),
            't_MontantTTC' => $DtoConvention->getMontantTTC(),
            't_Acompte' => $DtoConvention->getAcompte(),
            't_TVA' => $DtoConvention->getTVA(),
            't_Signature' => $DtoConvention->getSignature(),
            't_Commentaire' => $DtoConvention->getCommentaire()));
        
        
        $requete2 = 'SELECT * FROM convention WHERE NomProjet=? and DateDebut=? and DateFin=? and MontantHT=? and MontantTTC=? and Acompte=? and TVA=? and Signature=? and Commentaire=?;';
        
        $req2 = $this->bdd->prepare($requete2);
        
        $req2->execute(array($DtoConvention->getNomProjet(), $DtoConvention->getDateDebut(), $DtoConvention->getDateFin(), $DtoConvention->getMontantHT(), $DtoConvention->getMontantTTC(), $DtoConvention->getAcompte(), $DtoConvention->getTVA(), $DtoConvention->getSignature(), $DtoConvention->getCommentaire()));
         
        $data=$req2->fetch();
                       
        $DtoConvention->setNumConvention($data['NumConvention']);
        
        $req2->closecursor();
    }
    
    
    public function afficherTabConvention(){
        $requete = 'SELECT * FROM convention;';
        
        $requete->execute(array(
            't_NumConvention' => $DtoConvention->getNumConvention(),
            't_NomProjet' => $DtoConvention->getNomProjet(),
            't_DateDebut' => $DtoConvention->getDateDebut(),
            't_DateFin' => $DtoConvention->getDateFin(),
            't_MontantHT' => $DtoConvention->getMontantHT(),
            't_MontantTTC' => $DtoConvention->getMontantTTC(),
            't_Acompte' => $DtoConvention->getAcompte(),
            't_TVA' => $DtoConvention->getTVA(),
            't_Signature' => $DtoConvention->getSignature(),
            't_Commentaire' => $DtoConvention->getCommentaire()));
        
        echo'<table>';
            echo'<tr>'
                echo'<th>Numéro de convention</th>';
                echo'<th>Nom du projet</th>';
                echo'<th>Date début</th>';
                echo'<th>Date fin</th>';
                echo'<th>Montant HT</th>';
                echo'<th>Montant TTC</th>';
                echo'<th>Acompte</th>';
                echo'<th>TVA</th>';
                echo'<th>Signature</th>';
                echo'<th>Commentaire</th>';
            echo'</tr>';

   
    $requete = 'SELECT * FROM convention;';
    $reponse = $bdd->query($requete);
    
    while($data = $reponse->fetch()){
        echo '<td>'.$data['NumConvention'].'</td>';
        echo '<td>'.$data['NomProjet'].'</td>';
        echo '<td>'.$data['DateDebut'].'</td>';
        echo '<td>'.$data['DateFin'].'</td>';
        echo '<td>'.$data['MontantHT'].'</td>';
        echo '<td>'.$data['MontantTTC'].'</td>';
        echo '<td>'.$data['Acompte'].'</td>';
        echo '<td>'.$data['TVA'].'</td>';
        echo '<td>'.$data['Signature'].'</td>';
        echo '<td>'.$data['Commentaire'].'</td>';
    }
    
    $reponse->closeCursor();
        
    echo'</table>';
        

    #getter
    public function getByNumConvention($NumConvention){
        $requete = 'SELECT * FROM convention where NumConvention=?;';
        
        $req = $this->bdd->prepare($requete);
        
        $req->execute(array($NumConvention));
        
        $data = $req->fetch();
            
        $DtoConvention = new DtoConvention ($data['NumConvention'],$data['NomProjet'],$data['DateDebut'],$data['DatFin'],$date['MontantHT'], $data=['MontantTTC'], $data=['Acompte'], $data=['TVA'], $data=['Signature'], $data=['Commentaire']);
        
        $req->closeCursor();
        
        return $DtoConvention;
    }  
}