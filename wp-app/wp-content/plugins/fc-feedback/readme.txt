=== Fc Feedback ===
Contributors: AdnanHyder
Tags: Simple Voting System , feedback, Article, FC
Donate link: #
Requires at least: 5.0.0
Tested up to: 6.4.0
Requires PHP: 8.0
Stable tag: 1.0.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

The Fc Feedback plugin implements a straightforward feedback system for WordPress websites. It allows visitors to express their opinion on articles by voting with a Yes or No action. The plugin tracks and displays the voting results as an average percentage. Key features include:

    Two buttons for voting: Yes and No.
    Each vote adds a \"Positive\" or \"Negative\" count to the voting results.
    Voting results are displayed as an average percentage.
    Ajax request for submitting votes without page reload.
    Once a visitor votes, they can see the voting results immediately.
    Prevents visitors from voting twice on the same article using their fingerprint (e.g., IP address).
    Automatically displays the voting feature at the end of single post articles.
    Responsive design for compatibility across various devices and screen sizes.

== Description ==
The Fc Feedback plugin implements a straightforward feedback system for WordPress websites. It allows visitors to express their opinion on articles by voting with a Yes or No action. The plugin tracks and displays the voting results as an average percentage. Key features include:

    Two buttons for voting: Yes and No.
    Each vote adds a \"Positive\" or \"Negative\" count to the voting results.
    Voting results are displayed as an average percentage.
    Ajax request for submitting votes without page reload.
    Once a visitor votes, they can see the voting results immediately.
    Prevents visitors from voting twice on the same article using their fingerprint (e.g., IP address).
    Automatically displays the voting feature at the end of single post articles.
    Responsive design for compatibility across various devices and screen sizes.
Usage:
Frontend (Visitor Perspective):

    Visit any single post article on your website.
    Scroll to the end of the article to find the feedback feature.
    Click on the "Yes" or "No" button to submit your vote.
    After voting, you will see the current feedback results displayed as an average percentage.
    The buttons will remain inactive, but your vote will be displayed.
    Refreshing the page will retain the feedback results and your vote.

Backend (Admin Perspective):

    When editing an article in the admin area, you will see the feedback results in a meta widget.
    The meta widget displays the positive and negative percentage of feedback.


Hooks
    Two custom filter hooks also provided by this plugin

1. fc_feedback_form Filter Hook:

This filter hook allows developers to modify or extend the HTML output of the feedback form displayed on the frontend of the website. When the fc_feedback_form filter hook is applied, it passes the HTML code of the feedback form ($voting_html) as a parameter. Developers can then manipulate this HTML code to customize the appearance or functionality of the feedback form according to their specific requirements.

Example usage:

add_filter(\'fc_feedback_form\', \'customize_feedback_form\');

function customize_feedback_form($voting_html) {
    // Modify the HTML code of the feedback form here
    $voting_html .= \'

Custom content added to the feedback form.
\';
    return $voting_html;
}

In this example, the customize_feedback_form function adds custom content to the feedback form by appending it to the existing HTML code.

2. fc_feedback_results Filter Hook:

This filter hook allows developers to modify or extend the HTML output of the feedback results displayed on the admin side of the website. Similar to the fc_feedback_form hook, when the fc_feedback_results filter hook is applied, it passes the HTML code of the feedback results ($voting_html) as a parameter. Developers can then manipulate this HTML code to customize the appearance or presentation of the feedback results as needed.

Example usage:

add_filter(\'fc_feedback_results\', \'customize_feedback_results\');

function customize_feedback_results($voting_html) {
    // Modify the HTML code of the feedback results here
    $voting_html .= \'

Custom content added to the feedback results.
\';
    return $voting_html;
}

In this example, the customize_feedback_results function adds custom content to the feedback results by appending it to the existing HTML code.

By utilizing these filter hooks, developers can easily tailor the feedback form and results to suit their specific design preferences or functionality requirements

If you encounter any issues or have questions about the Fc Feedback plugin, please reach out to our support team at 12345adnan@gmail.com



== Installation ==
    Download the Fc Feedback zip file.
    Log in to your WordPress admin panel.
    Navigate to Plugins > Add New.
    Click on the \"Upload Plugin\" button.
    Choose the plugin zip file and click \"Install Now.\"
    Once installed, activate the plugin.

    Configuration
    on activation it will provide auto Configuration


== Frequently Asked Questions ==
1. How does the Fc Feedback plugin prevent visitors from providing multiple feedback on the same article?
The Fc Feedback plugin utilizes visitor fingerprinting methods, such as checking IP addresses, to prevent multiple feedback submissions from the same user on a single article. This ensures that each visitor can provide feedback only once per article, maintaining the integrity of the feedback data.

2. Can I customize the appearance of the feedback buttons to match my website\'s design?
Yes, you can easily customize the appearance of the feedback buttons to align with your website\'s theme. After activating the plugin, navigate to Settings > Fc Feedback in your WordPress admin panel. From there, you can customize button labels, colors, and other display settings to seamlessly integrate the feedback feature with your website\'s design aesthetic.

3. Is the Fc Feedback plugin compatible with all WordPress themes and plugins?
The Fc Feedback plugin is designed to be compatible with most WordPress themes and plugins. However, compatibility can vary depending on the complexity of your theme or the functionality of other plugins installed on your website. We recommend testing the plugin on a staging or development environment to ensure compatibility before deploying it on your live website.

4. Can I view the overall feedback statistics for all articles on my website?
Currently, the Fc Feedback plugin displays feedback statistics on a per-article basis. However, you can aggregate feedback data manually by exporting the feedback results from each article and compiling them into a single report. We are considering adding a feature for viewing overall feedback statistics in future updates based on user feedback and demand.

== Screenshots ==
1. Admin Metabox
2. Before voting
3. After voting

== Changelog ==
1.0.0
initial release