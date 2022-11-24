# ToDo's

* Groups functionality
  * Create, edit, delete groups
    * On three levels
      * Owner
      * Contractor
      * SubContractor
  * Add users to groups
* Projects functionality (only owner)
  * Create, edit, delete projects as an Owner
    * Add addresses to a project
      * Add contact information per address about the resident (Woningconsultant (is a user from the contractor) has the expliciet right to change the contact information for this project)
* Planning projects
  * Timeline planning per address
    * Prepare a list of tasks
    * Plan the tasks in time
  * Routing of addresses through project
    * Order of task through all the addresses
  * Historical timeline per address
* Projects
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
* Translations with Symfony/Translations (PoEdit from Reiny to translate the application)
* Two-factor authentication with SchebTwoFactorBundle
  * Through the Google authenticator app
  * And through the push notifications of a coupled Andriod to Google
* Symfony pre-registration and invite system
* A privately owned address in a housingstock of an owner
  * The owner of a housingstock can only view the information of this address
  * The real private owner does not have access to the application but legaly still owner of the data
  * After the legal term to archive the data is done (after 10 year) the data is deleted
* Frontend HTML lostrekken van JavaScript
  * Frontend template engine
  * Translations in frontend templates
* New frontend theme (See our old BLUE theme)