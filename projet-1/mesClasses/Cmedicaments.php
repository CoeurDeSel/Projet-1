<?php


/* ************ Classe métier Cmedicament et Classe de contrôle Cmedicaments **************** */
require_once 'mesClasses/Ctri.php';
require_once 'mesClasses/Cdao.php';

class Cmedicament
{

    public $id_med;
    public $designation_med;
    public $description_med;
    public $image;
    public $lien_pdf;
            
    function __construct($sid_med,$sdesignation_med,$sdescription_med,$simage,$slien_pdf) //s pour send param envoyé
    {

        $this->id_med = $sid_med;
        $this->designation_med = $sdesignation_med;
        $this->description_med = $sdescription_med;
        $this->image = $simage;
        $this->lien_pdf = $slien_pdf;
        
    }
}


class Cmedicaments 
{
 
    private $ocollMedicamentById;
    private $ocollMedicamentByLogin;
    private $ocollMedicament;
    /*private $tabVillemedicament;*/

    public function __construct()
    {
       
                  try {
                            $query = "SELECT * FROM medicament ";
                            $odao = new Cdao();
                            $lesmedicaments = $odao->gettabDataFromSql($query);
                            
                            foreach ($lesmedicaments as $unmedicament) 
                            {
                                $omedicament = new Cmedicament($unmedicament['id_med'],$unmedicament['designation_med'],$unmedicament['description_med'],$unmedicament['image'],$unmedicament['lien_pdf']);
                                $this->ocollMedicament[] = $omedicament;
                                $this->ocollMedicamentById[$omedicament->id_med] = $omedicament;
                                $this->ocollMedicamentByLogin[$omedicament->designation_med] = $omedicament;
                            }
                            
                            /*Les villes à partir de la base */
                            /*$query = "SELECT distinct ville FROM medicament order by ville ASC";
                            
                            $lesVilles = $odao->gettabDataFromSql($query);
                            
                            foreach ($lesVilles as $uneVille)
                            {
                                $this->tabVillemedicament[] = $uneVille['ville'];
                                
                            }
                            
                            /*Les villes à partir du tableau de tableau medicament */ 
                                
                       
                            
                            /*foreach($this->ocollMedicament as $omedicament)
                            {
                                $this->tabVillemedicament[] = $omedicament->ville;
                                
                            }
                            $this->tabVillemedicament = array_unique($this->tabVillemedicament);
                            sort($this->tabVillemedicament);*/
                            
                            
                            
                                
                            
                        }
                  catch(PDOException $e) {
                         $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                         die($msg);
                        }

    }
    
    //ici les méthodes à rajouter



    function getmedicamentById($sid_med)
    {
        if(array_key_exists($sid_med, $this->ocollMedicamentById))
        {
            $omedicament = $this->ocollMedicamentById[$sid_med];
            return $omedicament;
        }
    }
    
    /*function getmedicamentByLogin($designation_med)
    {
        if(array_key_exists($designation_med, $this->ocollMedicamentByLogin))
        {
            $omedicament = $this->ocollMedicamentByLogin[$designation_med];
            return $omedicament;
        }
    }*/
            
    function verifierInfosConnexion($username,$pwd)
    {
       
        foreach ($this->ocollMedicamentById as $omedicament)
        {
            if($omedicament->designation_med == $username && $omedicament->mdp == $pwd)
            {
                return $omedicament;
            }                  
        }
        return null;
    }
    
    function getMedicmentsTrie()
    {
        $otrie = new Ctri();
        $ocollMedicamentTrie = $otrie->TriTableau($this->ocollMedicament,'designation_med');
        return $ocollMedicamentTrie;
    }
    
    /*function getVillemedicament()
    {
        
        /*$otrie = new Ctri();
        $tabVille = $otrie->TriTableauObjetSurVille($this->ocollMedicament);
        $tabVilleTrie = array();
        foreach($tabVille as $omedicament)
        {
            $tabVilleTrie[] = $omedicament->ville;
            
        }
        return $tabVilleTrie;
        return $this->tabVillemedicament;
        
    }*/
    
    function getTabmedicamentsParNomEtVille($sdebutFin,$spartieNom,$sville)
    {
        $tabmedicamentsByVilleNom = null ;
        
        /*if($partieNom == '*' && $sville == 'toutes')
        {
            
            return $this->ocollMedicament;
        }*/
        
        foreach ($this->ocollMedicament as $omedicament) {
            
            if((strtolower($omedicament->ville) == strtolower($sville)) || $sville == 'toutes')
            {
                if($spartieNom != '*')
                {
                    if($sdebutFin == "debut")
                    {
                        $nomExtrait = substr($omedicament->description_med,0,strlen($spartieNom));

                        if(strtolower($nomExtrait) == strtolower($spartieNom))
                        {
                            $tabmedicamentsByVilleNom[] = $omedicament;
                        }                                      
                    }
                    if($sdebutFin == "fin")
                    {

                        $nomExtrait = substr($omedicament->description_med,-strlen($spartieNom),strlen($spartieNom));

                       if(strtolower($nomExtrait) == strtolower($spartieNom))
                        {
                            $tabmedicamentsByVilleNom[] = $omedicament;
                        }

                    } 

                    if($sdebutFin == "nimporte")
                    {
                        $i = 0;
                        $tab = str_split($omedicament->description_med);
                        foreach ($tab as $caract) 
                        {
                            $nomExtrait = substr($omedicament->description_med,$i,strlen($spartieNom));

                            if(strtolower($nomExtrait) == strtolower($spartieNom))
                            {
                                $tabmedicamentsByVilleNom[] = $omedicament;
                                break;
                            } 

                            $i++;
                        }


                    }
                }else{$tabmedicamentsByVilleNom[] = $omedicament;}
                
            }
            
        }
        
       
        
        return $tabmedicamentsByVilleNom;
    }
}


