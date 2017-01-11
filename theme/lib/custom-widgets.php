<?php
/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function example_add_dashboard_widgets() {
  wp_add_dashboard_widget(
     'example_dashboard_widget',   // Widget slug.
     'Opret ny udstiller',   // Title.
     'example_dashboard_widget_function' // Display function.
  );
}
add_action( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function example_dashboard_widget_function() {
  // Display whatever it is you want to show.
  echo "
  <ol>
    <li>Opret udstiller som bruger og sørg for de har rollen som forfatter</li>
      <ol>
        <li>Klik på [Brugere] -> [Tilføj ny]</li>
        <li>Udfyld brugernavn og email</li>
        <li>Giv dem rollen som forfatter (vigtigt!)</li>
        <li>Klik på gem-knappen [Tilføj ny bruger] og wordpress sender automatisk adgangskoden til dem</li>
      </ol>
    <li>Tilføj ny udstiller side</li>
    <ol>
      <li>Klik på [Udstillere] -> [Tilføj ny]</li>
      <li>Giv udstilleren en titel (fx John Deere)</li>
      <li>Ændr Forfatteren til netop oprettede bruger</li>
      <li>Udgiv udstilleren</li>
    </ol>
    <li>Del link til editor med udstiller</li>
    <ol>
      <li>Fra udstiller side editor kopierer du URL</li>
      <li>Send URL med email til udstiller bruger</li>
    </ol>
  </ol>
  Tillykke! Udstiller har nu adgang til editor af deres egen side og ingen andens.
  <br /><br />
  <iframe width='560' height='315' src='https://www.youtube.com/embed/wpyG77w7-Js?rel=0&amp;controls=0&amp;showinfo=0' frameborder='0' allowfullscreen></iframe>
  ";
}


// Remove all default widgets
function remove_dashboard_meta() {
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
}
add_action( 'admin_init', 'remove_dashboard_meta' );
