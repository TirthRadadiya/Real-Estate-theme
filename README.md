# Real Estate WordPress Theme

## Description
This is a custom real estate WordPress theme designed to showcase properties, agents, and cities. The theme includes custom post types, taxonomy templates, and user features like property registration, agent profiles, and saved listings. It also incorporates modern web technologies like Tailwind CSS for styling.

## Features
- **Custom Post Types**:
  - `property`: For adding and managing real estate listings.
  - `agent`: For adding agent profiles with contact functionality.
  - `city`: A custom taxonomy to categorize properties by location.
  
- **Pages**:
  - `Become an Agent`: A page allowing users to sign up as agents.
  - `Liked Posts`: Displays properties a user has liked.
  - `Profile`: Allows users to update their profile details.
  - `Register Property`: A form for users to list new properties.
  - `Login` & `Sign-up`: Custom authentication forms.

- **AJAX & REST API**:
  - AJAX forms for submitting properties and liking posts.
  - JWT authentication for secure user actions.

- **Email Integration**:
  - Send automated emails to agents when contacted via their profile. - To be added

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/real-estate-theme.git
   ```

2. **Install Dependencies**:
   Navigate to the theme folder and install necessary packages:
   ```bash
   npm install
   ```

3. **Activate the Theme**:
   - Upload the theme to your WordPress installation under `/wp-content/themes/`.
   - Activate it from the WordPress dashboard.

4. **Compile Assets**:
   Use Tailwind CSS for compiling styles:
   ```bash
   npm run build
   ```

## File Structure
```
real-estate-theme/
├── archive-agent.php
├── archive-property.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page-*.php (custom pages)
├── single-*.php (single post type templates)
├── style.css
├── assets/ (static assets like images, fonts)
├── dist/ (compiled CSS/JS files)
├── inc/ (PHP includes)
├── src/ (source files for JS and CSS)
├── templates/ (custom templates)
```

## Development

- **Tailwind CSS**: The theme uses Tailwind CSS for design. Modify the configuration in `tailwind.config.js`.
- **JavaScript**: Custom interactivity (like AJAX for property registration) is implemented in the `src/` directory.
  
## How to Contribute
Feel free to open issues or submit pull requests to contribute to the project.

## License
This project is licensed under the MIT License.
