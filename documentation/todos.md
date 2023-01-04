# ToDo's

* Groups functionality
  * Create, edit, delete groups
    * On three levels
      * Owner
      * Contractor (or Advisors with a certain property (beside the contractor under the owner))
      * SubContractor
  * Add users to groups
* Planning projects
  * Timeline planning per address
    * Prepare a list of tasks
    * Plan the tasks in time
  * Routing of addresses through project
    * Order of task through all the addresses
  * Historical timeline per address
* Projects
  * Create, edit, delete projects as an Owner
    * Add addresses to a project
      * Add contact information per address about the resident (Woningconsultant (is a user from the contractor) has the expliciet right to change the contact information for this project)
  * Project
    * Projectnummer (Lnummer, jaartal, maand, volgnummer)
    * Owner projectnummer
    * Contractor projectnummer
    * Subcontractor projectnummer
  * Attach documents to a project from owner (Are visible to contractor (no download, and no edit))
    * History of previous projects not in the system
    * MJOB document
    * Prestatie eisen
    * ...
  * Attach documents to a project from contractor (Are visible to owner (no download, and no edit))
    * HBO Haalbaarheidsonderzoek (Feasibility study document)
    * Task Risk Analysis document
    * Wet natuur bescherming (Flora- en Faunawet) request document and certificate
    * ...
  * Inspections on project level (in field visite)
    * Pictures (With location information)
    * Notes (With location information)
  * Inspections on address level (in field visite)
    * Pictures (With location information)
    * Notes (With location information)
* End project
  * Not access to contact information anymore for contractor
  * After 10 years the access to the entire project is blocked for the contractor
* Two-factor authentication with SchebTwoFactorBundle
  * Through the Google authenticator app
  * And through the push notifications of a coupled Andriod to Google
* Symfony pre-registration and invite system
  * When inviting a party to access a project you can limit the maximum set of rights that party can have
  * At a later moment this limit can be changed
* A privately owned address in a housingstock of an owner
  * The owner of a housingstock can only view the information of this address
  * The real private owner does not have access to the application but legaly still owner of the data
  * After the legal term to archive the data is done (after 10 year) the data is deleted

## Bugs
* ++++ Working version to show on laptop
  * Addressen overview crashes on production (uses too much memory)
  * Install a working local version on laptop 
* ++++ Arcgis is not working at the moment
* Invalidate cache of templates and js at the browser side

## Styling
* Zoeken op eind en begin van identificerende nummers
* Gebruiker aanpassen zou wachtwoord niet verplicht moeten zijn
* Bij een foutmelding moet er een terug knopje zijn
* Zoekbalk en titel moeten op de pagina zichtbaar blijven scroll alleen de tabel
* Zoekopdracht ook higlighten in het overzicht
* ++++ Aantal regels kunnen kiezen tussen, 10, 25, 50, 100
* ++++ Logo's van Jhonny na die van Dobro (Dobro, Owner, Contractor, Subcontractor)


