# language: fr
Fonctionnalité: posséder un compte bancaire
  Afin de gérer les comptes bancaires des utilisateurs
  En tant que client
  Je dois être capable d'effectuer des opérations basique sur mon compte

  Scénario: Avoir un compte bancaire valide
    Etant donné que je suis un nouveau client
    Alors je dois avoir "0" euros sur mon compte

  Scénario: Retirer de l'argent sur mon compte
    Etant donné que je suis un client
    Et que je possède "50" euros sur mon compte
    Quand je retire "10" euros
    Alors je dois avoir "40" euros sur mon compte

  Plan du Scénario: Ajouter de l'argent sur mon compte
    Etant donné que je suis un client
    Et que je possède "<soldeInitial>" euros sur mon compte
    Quand je dépose "<montant>" euros
    Alors je dois avoir "<soldeFinal>" euros sur mon compte

    Exemples:
      | soldeInitial    | montant | soldeFinal |
      | 0               | 10      | 10         |
      | 15              | 5       | 20         |
      | 35              | 5       | 40         |

  Scénario: Interdire les découverts
    Etant donné que je suis un client
    Quand j'essaye de retirer plus d argent que je n en ai sur mon compte
    Alors j'ai un message d erreur "Vous ne pouvez pas être à découvert"