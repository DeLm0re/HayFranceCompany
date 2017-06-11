<?php
class DBYnsayExeption extends Exception {}

class BDD
{
    const ERR_CONNEXION = "Une erreur est survenue, impossible de se connecter à la base de données";
    const ERR_NOT_FOUND = "Aucun résultat trouvé";
    private $_DBH;
    private $_ERR_MESSAGE;

    //Constructeur
    public function __construct() 
    {
        $this->_DBH = $this->getDbh();
        if ($this->_DBH === null)
        {
            throw new DBYnsayException(self::ERR_CONNEXION);
        }
    }
    
    /* Accesseur de la connexion à la base de données
     * Retour : 
     * $pdo : PDO d'accès à la BDD
     * null : en cas d'erreur
     */
    private function getDbh()
    {
        try 
        {
            $pdo = new PDO('mysql:host=localhost;dbname=hayfrance', 'root', '');
        } 
        catch (PDOExeption $e)
        {
            $this->_ERR_MESSAGE = $e->getMessage();
            return null;
        }
        return $pdo;
    }
    
    /* Effectue la requête à la base de données
     * Paramètres : $requete : requête à effectuer
     * Retour :
     * $resultat : résultat de la requête
     * (string)ERR_CONNEXION : si la connexion a échoué
     */
    public function exe_requete($requete)
    {
        try
        {
            $prepare = $this->_DBH->prepare($requete);
            $prepare->execute();
            $resultat = $prepare->fetchAll(PDO::FETCH_ASSOC);
            if($resultat === NULL)
            {
                return self::ERR_NOT_FOUND;
            }
            return $resultat;    
        } catch (PDOExeption $e) 
        {
            $this->_ERR_MESSAGE = $e->getMessage();
            return self::ERR_CONNECTION;
        }
    }
    
    public function bind_requete($requete, $param)
    {
        try
        {
            $index = 1;
            $prepare = $this->_DBH->prepare($requete);
            
            for($index = 1; $index <= count($param); $index++)
            {
                $prepare->bindParam($index, $param[$index]);
            }
            
            $prepare->execute();
            $resultat = $prepare->fetchAll(PDO::FETCH_ASSOC);
            if($resultat === NULL)
            {
                return self::ERR_NOT_FOUND;
            }
            return $resultat;    
        } catch (PDOExeption $e) 
        {
            $this->_ERR_MESSAGE = $e->getMessage();
            return self::ERR_CONNECTION;
        }
    }
}

