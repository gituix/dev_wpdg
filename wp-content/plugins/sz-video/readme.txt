=== SZ - Video for WordPress ===
Contributors: massimodellarovere
Requires at least: 3.4
Tested up to: 3.5
Stable tag: 2.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F6K9EMHKWRFPL
Tags: autoplay, caption, cloudfront, cover image, cover video, dailymotion, dailymotion embed, dailymotion player, dailymotion videos, embed, embedding, embed dailymotion, embed youtube, embed vimeo, embed videos, flowplayer, iframe, loop, microdata, player, plugin, responsive, rich snippet, schema.org, seo, shortcode, youtube, youtube embed, youtube player, youtube videos, video, video analytics, video caption, video cover, video HTML5, video seo, vimeo, vimeo player, vimeo embed, vimeo videos

Plugin per l'inserimento di un player video all'interno di post o pagine WordPress tramite l'utilizzo di semplici shortcodes.

== Description ==

<a href="http://wordpress.org/extend/plugins/sz-video/">Italiano</a> - <a href="http://goo.gl/dq49n">English</a> - <a href="http://goo.gl/l8DcC">Español</a>

Con questo plugin è possibile inserire del proprio blog dei filmati video utilizzando il **responsive design**, potremmo scegliere diversi metodi di inserimento e diverse fonti di distribuzione. In questo momento il plugin permette l'inserimento di video da <a href="http://www.youtube.com/">Youtube</a>, da <a href="http://vimeo.com/">Vimeo</a>, da <a href="http://www.dailymotion.com/">DailyMotion</a>, video memorizzati localmente e video presenti su alcune CDN per lo streaming. Per la visualizzazione di video locali e in streaming verrà utilizzato il player di <a href="http://flowplayer.org/">Flowplayer.org</a> in tecnologia HTML5 e quindi usando il nuovo tag `<video>`. 

[youtube http://www.youtube.com/watch?v=vAzl3bXxBgg]

L’inserimento dei video verrà effettuato con l'utilizzo di particolari shortcode. Ogni shortcode provvederà ad una singola tipologia di inserimento ed avrà la possibilità di indicare i parametri di configurazione direttamente nel comando. In ogni caso esiste anche uno shortcode generico chiamato `[sz-video]` il quale in base all'URL indicato richiamerà automaticamente quello specifico.

* <a href="http://startbyzero.com/webmaster/wordpress-plugin/sz-video/" title="SZ-Video for WordPress">Home page</a>
* <a href="http://startbyzero.com/webmaster/wordpress-plugin/sz-video/sz-video-demo-live/" title="Demo live">Demo online</a>
* <a href="http://startbyzero.com/webmaster/wordpress-plugin/sz-video/sz-video-demo-html5/" title="Demo live">Demo online HTML5</a>
* <a href="https://startbyzero.com/demos/wordpress/plugin-video/" title="Demo live">Demo online (wordpress 3.5)</a>
* <a href="https://startbyzero.com/demos/wordpress/plugin-video-html5/" title="Demo live">Demo online (wordpress 3.5) HTML5</a>
* <a href="https://plus.google.com/communities/109254048492234113886" title="Demo live">Community su Google+</a>

**Shortcode [sz-video]:** Tramite questo shortcode potete inserire un video nel vostro blog, basta specificare l’indirizzo URL del video ed eventualmente le dimensioni. Se non vengono specificate ulteriori opzioni verranno usate quelle della configurazione generale, impostate dopo l'installazione del plugin dal pannello di amministrazione.

`[sz-video url="url" width="opzionale" height="opzionale"/]`

Nel valore URL potete specificare sia un indirizzo locale o un servizio esterno supportato dal plugin come ad esempio il formato classico di `youtube.com`.

`[sz-video url="http://youtu.be/1vJHTa1_Oys"/]`

Se volete fare una prova di funzionamento generale appena installato il plugin, senza dover caricare un video sul vostro server, potete utilizzare il valore speciale "demo" nel parametro URL, in questa maniera dovreste visualizzare un video di dimostrazione memorizzato sul vostro server nella directory del plugin.

`[sz-video url="demo"/]`

NB: Se nelle opzioni è presente l’impostazione *(responsive=yes)* allora le dimensioni specificate non valgono, in quanto il video si adatta automaticamente alla dimensione del contenitore, se invece è specificato *(responsive=no)* verranno prese come dimensioni quelle specificate nella configurazione che per default sono 600×400. Ovviamente queste dimensioni possono essere forzate:

`[sz-video url="url" width="500" height="250"/]`

Anche i valori dei margini che indicano la distanza del contenitore del video dal testo circostante è un valore che è specificato nelle opzioni generali di configurazione, però come per tutti gli altri parametri potete modificarli anche direttamente sul vostro shortcode:

`[sz-video url="url" margintop="10" units="px"/]`

**Formati video HTML5:** Anche se sullo shortcode viene specificato un solo file che può essere di tipo webm, mp4 o ogv, nel tag HTML5 video vengono aggiunti tutti i formati disponibili, questo per facilitare il cross browser. Se volete disattivare questa funzione, andate nel pannello di amministrazione, nella sezione player HTML5 e disattivate i video da aggiungere.

`[sz-video url="http://dominio/ilmiovideo.webm"/]`

*Attenzione:* In questo caso vengono aggiunti automaticamente anche i formati mp4 e ogg in maniera tale che il browser selezioni da solo il formato che gli interessa e a cui è compatibile, quindi nel vostro file system dovete memorizzare tutti i formati richiesti in HTML5, se volete evitare questo comportamento andate sul pannello di controllo su opzioni player HTML5 e deselezionate i valori che trovate nella sezione `Select video to add the tag [video]`. Un modo alternativo per ottenere lo stesso risultato è quello di specificare direttamente sullo shortcode il parametro onlyurl in questo modo: 

`[sz-video url="http://dominio/ilmiovideo.webm" onlyurl="y"/]`

**Cover image:** Se specifichiamo il parametro come cover=`"default"` verrà caricata un'immagine di default memorizzata nel plugin, altrimenti potete specificare l'indirizzo URL dell'immagine che volete usare, basta specificare nello shortcode il parametro cover=`"indirizzo URL immagine"`.

`[sz-video url="url" cover="URL" method="N"/]`

**Rapporto dell'aspetto (ratio):** E' possibile specificare il parametro ratio per indicare il rapporto che deve essere usato nel calcolo dell'altezza in base alla larghezza del video che si adatta al contenitore principale in responsive design.

`[sz-video url="url" cover="URL" ratio="0.431"/]`

**Shortcode specifico:** Per l'inserimento di video dai portali <a href="http://www.youtube.com/">Youtube</a>, <a href="http://vimeo.com/">Vimeo</a> e <a href="http://www.dailymotion.com/">DailyMotion</a> potete utilizzare anche gli shorcode specifici `[sz-youtube]` - `[sz-vimeo]` e `[sz-dailymotion]` esattamente nella stessa maniera spiegata per quello generico, le caratteritiche e le opzioni di configurazione che potete specificare nel codice sono identiche.

`[sz-youtube url="url" width="opzionale" height="opzionale"/]`

**Caricamento codice embed:** Molte volte abbiamo la necessità di **non** dover caricare subito il codice embed nella pagina web, ad esempio se ripetessimo per molte volte lo shortcode, le performance sarebbero scadenti, in quanto facciamo caricare al browser un sacco di codice che sicuramente l’utente non userà, perchè selezionerà solo un filmato dei tanti presenti.

*Per risolvere questo problema possiamo caricare solo l’immagine del video facendo partire il caricamento del codice embed solo se l’utente clicca sull’immagine del video selezionato. Questo comportamento è possibile sempre specificarlo nelle opzioni di configurazione generali, ma in ogni caso possiamo forzare l’utilizzo direttamente sullo shortcode con il parametro `method`:*

`[sz-video url="url" method="Y"/] // Viene subito caricato`

**SEO Video:** Nel pannello di controllo del plugin è possibile attivare la funzione per la creazione di tags standard secondo le specifiche di schema.org, in questa maniera è possibile ottenere dai motori di ricerca come google, dei rich snippet personalizzati che tendono ad aumentare il CTR della vostra pagina web.

`[sz-video url="url" schemaorg="Y" duration="480"/]`

**Azioni del video:** Nei parametri presenti nello shortcode possiamo anche indicare l'avvio automatico del video e la ripetizione infinita, basta specificare nello shortcode i parametri specifici. 

`[sz-video url="url" autoplay="Y" loop="Y"/]`

**Parametri particolari:** Quando inseriamo il nostro video potremmo avere bisogno di specificare dei parametri particolari legati al portale specifico e quindi non standardizzati dal plugin, per risolvere in parte questo problema potete aggiungere una stringa a vostro piacimento che verrà aggiunta ai parametri specificati sull'URL di default.
 
`[sz-video url="youtube-url" userdata="autohide=2&cc_load_policy=1"/]`

* <a href="https://developers.google.com/youtube/player_parameters#Parameters">Elenco dei parametri per video Youtube</a>
* <a href="http://developer.vimeo.com/player/embedding">Elenco dei parametri per video Vimeo</a>
* <a href="http://www.dailymotion.com/doc/api/player.html">Elenco dei parametri per video DailyMotion</a>

== Installation ==

<a href="http://wordpress.org/extend/plugins/sz-video/installation/">Italiano</a> - <a href="http://goo.gl/xLbNl">English</a> - <a href="http://goo.gl/Gnm6s">Español</a>

= Installazione automatica =

1. Pannello di amministrazione plugin e opzione `aggiungi nuovo`.
2. Ricerca nella casella di testo `sz-video`.
3. Posizionati sulla descrizione di questo plugin e seleziona installa.
4. Attiva il plugin dal pannello di amministrazione di WordPress.

= Installazione manuale file ZIP =

1. Scarica il file .ZIP da questa schermata.
2. Seleziona opzione aggiungi plugin dal pannello di amministrazione.
3. Seleziona opzione in alto `upload` e seleziona il file che hai scaricato.
4. Conferma installazione e attivazione plugin dal pannello di amministrazione.

= Installazione manuale FTP =

1. Scarica il file .ZIP da questa schermata e decomprimi.
2. Accedi in FTP alla tua cartella presente sul server web.
3. Copia tutta la cartella `sz-video` nella directory `/wp-content/plugins/`
4. Attiva il plugin dal pannello di amministrazione di WordPress.

[youtube http://www.youtube.com/watch?v=vAzl3bXxBgg]

= Gruppo di Discussione su Wordpress =

Se riscontrate qualche problema sul plugin o volete dare qualche consiglio sulle future implementazioni scrivete pure alla <a href="https://plus.google.com/communities/109254048492234113886">Community su Wordpress</a> presente su Google Plus - creata da appassionati del settore.

= Utilizzo degli shortcodes dopo installazione =

Una volta installato il plugin potete subito inserire nei vostri post il comando per l'inserimento di un video, ad esempio utilizzando questo formato 

`[sz-video parametro="valore" parametro="valore"/]`

Questi parametri possono essere indicati direttamente nello shortcode o configurati una volta sola come "default" nel pannello di controllo.

* Indirizzo URL del video --> `url="stringa"` o `url="demo"`
* Metodo di embed --> `method="Y"` o `method="N"`
* Dimensione Responsive --> `responsive="Y"` o `responsive="N"`
* Largezza in px --> `width="numero"`
* Altezza in px --> `height="numero"`
* Margine alto --> `margintop="numero"`
* Margine destro --> `marginright="numero"`
* Margine basso --> `marginbottom="numero"`
* Margine sinistro --> `marginleft="numero"`
* Cover image --> `cover="default"` o `cover="URL"`
* Rapporto ratio --> `ratio="numero"` esempio "0.4134"
* Schema.org --> `schemaorg="Y"` o `schemaorg="N"`
* Titolo --> `title="stringa"`
* Descrizione --> `description="stringa"`
* Durata --> `duration="secondi"`
* Avvio automatico --> `autoplay="Y"` o `autoplay="N"`
* Ripetizione del video --> `loop="Y"` o `loop="N"`
* Parametri personalizzati --> `userdata="stringa"`
* Allineamento --> `float="L"` o `float="R"`
* Solamente URL indicato --> `onlyurl="Y"` o `onlyurl="N"`
* Testo da inserire sotto il video --> `caption="stringa"`

== Frequently Asked Questions ==

<a href="http://wordpress.org/extend/plugins/sz-video/faq/">Italiano</a> - <a href="http://goo.gl/YHgIR">English</a> - <a href="http://goo.gl/zzeID">Español</a>

= E' possibile vedere una demo prima dell'installazione ? =

Si, abbiamo messo a disposizione delle pagine di dimostrazione dove visionare il plugin installato sull'ultima versione di WordPress disponibile al momento. Potete visitare la pagina <a href="https://startbyzero.com/demos/wordpress/plugin-video/">SZ-Video Demo</a> e la pagina <a href="https://startbyzero.com/demos/wordpress/plugin-video-html5/">SZ-Video Demo in HTML5</a>.

= Che formato devo usare per video locali in HTML5 ? =

I formati che si necessitano per essere compatibili con tutti i browser sono mp4, ogg e webm, nello shortcode come parametro url basta inserirne uno e gli altri vengono inseriti automaticamente nel comando HTML5 <video>, ovviamente dovete memorizzare sul vostro server tutti i formati, in maniera tale che il browser scelga il iù idoneo e lo trovi sul server di destinazione. Se questo automatismo lo volete disattivare potete andare nel pannello di admin sz-video e disattivare la funzione di "aggiunta formati automatici", se invece lo volete disattivare su un solo video allora usate lo shortcode con il parametro onlyurl="y".

= Cosa indica il parametro Responsive ? =

Ultimamente grazie al mondo dei *device mobili* si usa sempre di più la tecnica Responsive, cioè le dimensioni delle varie sezioni di un sito non sono più solo studiate secondo le dimensioni di un monitor classico, ma si autodimensionano rispetto al device che consulta il sito web. Quindi se prima aveva senso specificare delle dimensioni al player video in base al layout del nostro sito, adesso attivando questo parametro le dimensioni si adatteranno al contenitore Responsive e quindi ignorando i valori fissi specificati in pixel.

= Che tipologia di video posso inserire ? =

Per il momento possiamo inserire video presenti su <a href="http://www.youtube.com/">Youtube</a>, su <a href="http://vimeo.com/">Vimeo</a>, su <a href="http://www.dailymotion.com/">DailyMotion</a>, memorizzati localmente sul nostro server web o disponibili su una CDN con la possibilità di usare il protocollo riguardante lo streaming. Invece se il video viene servito dal player locale allora posso essere elaborati solo video di tipo webm, mp4 e ogv che saranno usati in base al browser usato. Per ulteriori informazioni cercate la documentazione riguardante video in HTML5.

= Posso attivare l'ottimizzazione SEO per i video ? =

In questo momento il plugin permette l'inserimento dei tags rispettando lo standard di schema.org. Questa funzione può essere abilitata o disabilitata dal pannello di amministrazione sotto la voce della configurazione di base.

= A cosa serve il parametro Warning deactivation ? =

Quando disattiviamo uno shortcode è possibile che nei nostri articoli rimanga comunque la stringa dello shortcode interessato, se questo parametro è stato attivato, al posto dello shortcode verrà inserito un messaggio di warning, altrimenti la stringa del comando shortcode sarà semplicemente ignorata.

= Si può personalizzare l'immagine del video inserito ? =

Se viene richiesto l'inserimento del codice embed immediato con method='Y' l'immagine del video sarà quella predefinita del sistema video usato, quindi youtube, vimeo, dailymotion, ect. Se invece specifichiamo method='N' possiamo decidere tre cose diverse. Se non specifichiamo niente viene presa l'immagine di default come il metodo classico, se specifichiamo `cover="default"` viene usata un'immagine di default memorizzata nel plugin, se specifichiamo `cover="indirizzo URL"` viene caricata l'immagine dall'indirizzo specificato. In questo ultimo caso verificare bene il formato dell'indirizzo URL in quanto il plugin non esegue nessun controllo di esistenza link.

= Che software viene utilizzato per i video in HTML5 ? =

Per l'inserimento di video HTML5, quindi tutti quelli che hanno specificato nel parametro URL un valore che non è riconducibile ad un servizio di terzi, viene utilizzato il software di <a href="http://flowplayer.org/">Flowplayer.org</a> rilasciato sotto licenza GPL. Questo software ha anche una versione commerciale che rispetto a quella free permette di inserire nel player un proprio logo personalizzato.

= Posso forzare l'utilizzo di HTTPS per l'inserimento di video ? =

Molte volte ci troviamo nella necessità di usare il protocollo HTTP o HTTPS in base al metodo di richiamo della pagina, purtroppo nel link che usiamo nello shortcode possiamo usare solo una forma, però il plugin ci viene incontro facendo (se l'opzione in configurazione è attiva) la conversione dell'indirzzio URL del video in base al protocollo usato per la pagina in corso.

== Screenshots ==

1. Pannello di Amministrazione generale
2. Pannello di Amministrazione Player HTML5
3. Tema WordPress standard con plugin SZ-Video
4. Esempio di inserimento Video Youtube
5. Esempio di inserimento Video Vimeo
6. Esempio di inserimento Video DailyMotion
7. Finestra POP-UP per inserimento shortcode
8. Esempio di inserimento Video con Flowplayer
9. Utilizzo del plugin come widget su sidebar

== Changelog ==

<a href="http://wordpress.org/extend/plugins/sz-video/changelog/">Italiano</a> - <a href="http://goo.gl/fYZvP">English</a> - <a href="http://goo.gl/Qmn5Q">Español</a>

= Versione 2.6 =
* Update: Aggiornamento flowplayer alla versione 5.4.3.
* Feature: Supporto stringa per una didascalia sotto il video.
* Feature: Supporto google analytics per video con flowplayer.
* Fix: Parametro onlyurl alcune volte non funzionante.
* Fix: Cover image con caratteri maiuscoli non veniva caricata.

= Versione 2.5 =
* Fix: Pulsante insert non funzionante su pop-up shortcode.
* Fix: Icone delle funzioni video per editor tinymce.
* Fix: Finestra pop-up non corretta con browser firefox.
* Fix: Modifica CSS per pannello amministrazione cross browsers.

= Versione 2.4 =
* Feature: Aggiunto il supporto per widget da usare in sidebar.
* Feature: Aggiunti alcuni parametri per schema.org standard.
* Feature: Modifica del video dentro sidebar con responsive.
* Feature: Aggiunti alcuni parametri di configurazione.

= Versione 2.3 =
* Fix: Nuovi campi sulla windows pop-up per inserimento shortcode 
* Fix: Aggiunte alcune stringhe per la traduzione in italiano
* Fix: Modifica di alcuni screenshot allegati al plugin
* Fix: Miglioramento performance pop-up su editor MCE 

= Versione 2.2 =
* Fix: Amministrazione per opzione video to add the tag [video]
* Fix: Parametro onlyurl per non aggiungere formati automatici HTML5.
* Fix: Popup shortcode messaggio "internal server error" IIS
* Fix: Migliorate le performance per la creazione del codice embed.

= Versione 2.1 =
* Fix: Cover image youtube di preview in alta risoluzione 
* Fix: URL non valido (errato) in condizioni particolari
* Fix: Modifica elaborazione popup shortcode con Ajax
* Fix: Popup shortcode messaggio "internal server error" IIS

= Versione 2.0 =
* Feature: Aggiunto il supporto per loop
* Feature: Aggiunto il supporto per autoplay
* Feature: Aggiunto il supporto per parametri personalizzati
* Feature: Aggiunto il supporto per float right & left

= Versione 1.9 =
* Feature: Aggiunto il supporto per i tags di schema.org.
* Feature: Aggiunto titolo e descrizione personalizzata.
* Feature: Enable/Disable schema.org da pannello di amministrazione.
* Fix: Video non trovato quando si specifica una porta su URL.

= Versione 1.8 =
* Fix: Correzione Youtube Autoplay in HTML5.
* Fix: Correzione sul calcolo del margine basso.
* Fix: Cancellazione opzioni su disinstallazione multisite.

= Versione 1.7 =
* Feature: Aggiunto parametro (ratio) per player HTML5.
* Feature: Selezione per inserire icone pop-up su editor.
* Feature: Aggiunto il parametro per conversione HTTP/HTTPS.
* Fix: Creazione nuove opzioni in fase di plugin update.
* Fix: Miglioramento del codice sorgente in generale.
* Fix: Modifica calcolo dimensione del player HTML5.

= Versione 1.6 =
* Player: Player video CSS per minimale, funzionale e completo.
* Player: Configurazione in admin per scelta CSS del player.
* Player: Webm, mp4 e ogv da aggiungere al tag HTML5 video.
* Fix: Finestra pop-up per shortcode generico [sz-video].
* Fix: Traduzione di alcune stringhe mancanti in italiano.

= Versione 1.5 =
* Feature: Creazione shortcode `[sz-video]` generico.
* Feature: Creazione player con utilizzo di Flowplayer 5.2.0
* Feature: Embed tramite tencologia HTML5 e tag <video>
* Feature: Embed video locali e su altri domini HTTP o HTTPS.

= Versione 1.4 =
* Feature: Personalizzare la cover image tramite un URL.
* Fix: Alcuni errori che si verificavano sul pop-up dello shortcode.
* Fix: Traduzione di alcune stringhe mancanti in italiano.
* DailyMotion: Finestra pop-up per facilitare inserimento shortcode.
* Description: Aggiornati i screenshot del prodotto.

= Versione 1.3 =
* DailyMotion: Inserimento shortcode `[sz-dailymotion url="url"/]`.
* DailyMotion: Embed del player con dimensione in tecnica Responsive.
* DailyMotion: Visualizzazione della cover image originale.

= Versione 1.2 =
* Fix: Errore sul calcolo dei margini CSS per iframe player.
* Vimeo: Inserita finestra pop-up per lo shortcode come youtube.

= Versione 1.1 =
* Vimeo: Inserimento shortcode `[sz-vimeo url="url"/]`.
* Vimeo: Embed del player con dimensione in tecnica Responsive.
* Vimeo: Visualizzazione della cover image originale prima del codice embed.

= Versione 1.0 =
* Youtube: Inserimento shortcode `[sz-youtube url="url"/]`.
* Youtube: Possibilità di specificare il formato URL youtube in versione short.
* Youtube: Embed del player con dimensione in tecnica Responsive.
* Youtube: Visualizzazione della cover image originale prima del codice embed.

== Upgrade Notice ==

= 2.6 =
Aggiunto il supporto per google analytics agli eventi collegati al video, inserita la possibilità di specificare un testo di caption per la creazione di una didascalia sotto il video visualizzato.

= 2.5 =
Modificate alcune funzioni che non calcolavano correttamente il path della directory wp-include causando errori di funzionamento su installazioni fatte in directory non standard.

= 2.0 =
Aggiunti alcuni parametri di configurazione come autoplay, float e loop. Questi valori possono essere indicati direttamente sullo shortocde del singolo video da includere nel post di wordpress.

= 1.8 =
Correzione di alcuni bugs e modifica calcolo delle dimensioni per player HTML5. Miglioramenti sulle fasi di installazione e disinstallazione in ambiente multisite.

= 1.7 =
In questa release è stata rivista la gestione della dimensione del video e corretti alcuni malfunzionamenti derivati dall'utilizzo di dimensione fissa o responsive design.

= 1.6 =
Sono state aggiunte delle opzioni di configurazione per decidere il tipo di player da usare nella visualizzazione dei video no embed, sarà possibile scegliere tra minimale, funzionale e completo. Cambiata la gestione automatica di aggiunta webm, mo4 e ogv al tag HTML5 video.

= 1.5 =
Aggiunto lo shortcode generico che in base a URL specificato richiama automaticamente quello necessario. Da questa release potete anche inserire video memorizzati sul vostro server o verso file di altri domini con protocollo HTTP e HTTPS.

= 1.4 =
Release di aggiornamento per sistemare alcuni piccoli difetti e migliorie generali. E' stata aggiunta anche la possibilità di gestire una cover image personalizzata.

= 1.3 =
Tutte le funzioni che erano state sviluppate per lo shortcode di youtube e vimeo adesso sono disponibili per l'inserimento di video presenti su DailyMotion. Bisogna utilizzare il nuovo shortcode [sz-dailymotion].

= 1.2 =
Su questa versione sono stati corretti alcuni bugs generali e sono state aggiunte delle funzionalità che riguardano la gestione della cover image da applicare al player prima del codice embed.

= 1.1 =
Tutte le funzioni che erano state sviluppate per lo shortcode di youtube adesso sono disponibili per l'inserimento di video presenti su Vimeo. Bisogna utilizzare il nuovo shortcode [sz-vimeo].

= 1.0 =
Completamente rivisto il codice per l'inserimento di video youtube. Adesso tutti i parametri sono personalizzabili. E' stata aggiunta la possibilità di eseguire il codice embed solo dopo il clic dell'utente, verrà visualizzata al posto del player la cover image originale.

