# Exercice ORM - Blog information automatique

## **1-Liste des données nécessaires :**

*Données pour les dépêches AFP :*
 ````
Identifiant de la dépêche
 Titre de la dépêche
 Contenu de la dépêche
 Date de publication de la dépêche
 Source de la dépêche
 ````
*Données pour les articles générés :*
````
 Identifiant de l'article
 Titre de l'article
 Contenu de l'article
 Date de création de l'article
 URL de l'article
 Statut de publication de l'article (brouillon, publié)
 Auteur de l'article (IA générative)
````
*Données pour les illustrations :*
````
 Identifiant de l'illustration
 URL de l'illustration
 Description de l'illustration
 Date de création de l'illustration
````
 *Données pour les tags :*
 ````
 Identifiant du tag
 Nom du tag
 ````
*Données pour l'IA générative :*
````
Identifiant de l'IA générative
Type de l'IA générative (texte ou image)
Fonction de l'IA générative

````
*Relations entre les entités :*
````
Une dépêche AFP peut générer plusieurs articles.
Un article peut avoir plusieurs illustrations.
Un article peut avoir plusieurs tags.
Un article utilise une IA générative pour le texte.
Une illustration utilise une IA générative pour l'image.
````
## **2- Diagramme de classe UML :**

![Capture d’écran (399)](https://github.com/ilierrazi00/Exercice_ORM/assets/94292513/651a5a37-18a2-4188-8178-937a1b106547)

## **3- Diagramme MCD Merise :**

![DiagrammeMcdMerise](https://github.com/ilierrazi00/Exercice_ORM/assets/94292513/b895a58e-5538-4834-a87f-ccfa0f86f1be)


## **4- Schéma Relationnel crée par ORM Doctrine & Symfony :**

![Capture d’écran (401)](https://github.com/ilierrazi00/Exercice_ORM/assets/94292513/48af0ad0-1af9-4e16-b92e-9d1626a8f511)



