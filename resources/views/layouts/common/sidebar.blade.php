 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="{{ url('/') }}" class="brand-link text-decoration-none ">
         <span class="brand-text font-weight-light">Practical Task</span>
     </a>
     <div class="sidebar" style="overflow-y:auto; max-height:80vh; scrollbar-width: 0rem !important">
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <li class="nav-item">
                     <a href="{{ route('home') }}" class="nav-link">
                         <i class="nav-icon fa fa-square"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Tasks</p>
                    </a>
                 </li>
             </ul>
         </nav>
     </div>
 </aside>
 @push('scripts')
     <script>
         document.addEventListener('DOMContentLoaded', () => {
             const toggleButton = document.querySelector('[data-widget="pushmenu"]');
             const body = document.body;

             if (toggleButton) {
                 toggleButton.addEventListener('click', (e) => {
                     e.preventDefault();
                     body.classList.toggle('sidebar-collapse');
                     body.classList.toggle('sidebar-expanded');
                 });
             }

             const academicDropdown = document.querySelector('.has-treeview');
             const academicDropdownLink = academicDropdown.querySelector('.nav-link');
             const academicDropdownMenu = academicDropdown.querySelector('.nav-treeview');

             if (academicDropdownLink) {
                 academicDropdownLink.addEventListener('click', (e) => {
                     e.preventDefault();

                     // Toggle the classes on a specific child element of the link
                     const icon = academicDropdownLink.querySelector('.menu-dropdown'); // Replace '.icon-class' with the correct class
                     if (icon) {
                         icon.classList.toggle('fa-angle-left');
                         icon.classList.toggle('fa-angle-down');
                     }

                     // Toggle the dropdown menu display
                     if (academicDropdownMenu) {
                         academicDropdownMenu.style.display = academicDropdownMenu.style.display === 'none' ?
                             'block' : 'none';
                     }
                 });
             }
         });
     </script>
 @endpush
