<div class="bg-[#2E2E2E] shadow-lg">
    <div class="max-w-[1250px] mx-auto px-3 h-16 flex justify-between items-center">
        
        <?php if (isset($user) && $user instanceof User): ?>

            <div>
                <a href="/pages/courses.php" class="font-semibold text-lg no-underline text-white" style="font-family: 'Playwrite IN', serif;"><span class="text-[#00A5CF]" style="font-family: 'Playwrite IN', serif;">Y</span>oudemy</a>
            </div>

            <div class="relative">
                <button type="button" class="bg-[#D9D9D9] search-btn bg-opacity-15 flex items-center py-2 px-5 text-[#B2B2B2] rounded-full w-36 border border-gray-500 justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-[#B2B2B2]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    <span>Search</span>
                </button>
                <div class="absolute z-20 top-16 left-1/2 hidden search-window w-screen max-w-lg rounded border border-gray-300 bg-white shadow-[0px_0px_10px_rgba(0,0,0,0.2)] px-4 py-5 -translate-x-1/2">
                    <div class="px-2">
                        <div class="items-center justify-between flex mb-3">
                            <label for="search-for" class="font-semibold">Search for</label>
                            <select class="search-option py-1.5 px-3 rounded bg-[#00A5CF20] border border-[#00A5CF] w-34" id="search-for">
                                <option value="courses">Courses</option>
                                <option value="teachers">Teachers</option>
                            </select>
                        </div>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-700 absolute top-2 left-3" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            <input type="text" placeholder="Type in something ..." class="outline-none search-input py-1.5 ps-10 placeholder:text-gray-600 px-3 rounded bg-[#00A5CF20] border border-[#00A5CF] w-full">
                        </div>
                    </div>
                    <div class="text-center my-5">
                        <span class="font-semibold px-3 bg-white relative z-10">Results</span>
                        <div class="w-52 h-px bg-gray-300 mx-auto relative bottom-3"></div>
                    </div>
                    <div class="results-screen flex flex-col gap-7 max-h-80 px-2 overflow-auto">
                        <p class="text-center text-gray-600">You have not searched yet</p>
                    </div>
                </div>
            </div>

            <div class="*:ml-7 *:font-semibold text-white flex items-center">
                <a href="/pages/courses.php" class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                    <span>Home</span>
                </a>

                <a href="/pages/courses.php" class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
                    <span>Notifications</span>
                </a>
                <div class="relative">
                    <button class="block w-9 h-9 rounded-full overflow-hidden border-2 border-[#00A5CF] user-menu">
                        <img src="<?php echo $user ->getImageUrl(); ?>" alt>
                    </button>
                    <div class="absolute right-0 z-30 -bottom-5 translate-y-full w-72 hidden rounded bg-gray-200 shadow-lg border border-gray-300 text-gray-700">
                        <div class="rounded-full w-14 h-14 block mx-auto mt-5 border-[#00A5CF] overflow-hidden border-2">
                            <img src="<?php echo $user ->getImageUrl(); ?>">
                        </div>
                        <h3 class="text-center font-semibold text-lg pt-3"><?php echo $user -> getFullName(); ?></h3>
                        <h4 class="text-gray-500 font-normal text-center text-sm"><?php echo ucfirst($user -> getRole()); ?></h4>
                        <div class="h-px w-40 bg-gray-300 mx-auto my-3"></div>
                        <div>
                            <div class="py-2">
                                <a href="#" class="block py-1.5 px-5">Profile</a>
                                <!-- <a href="#" class="block py-1.5 px-5">My Posts</a> -->
                                <!-- <a href="#" class="block py-1.5 px-5">My Statistics</a> -->
                                <?php if($user -> getRole() == "student"): ?>
                                    <a href="/pages/student/my-subscriptions.php" class="block py-1.5 px-5">My Subscriptions</a>
                                <?php elseif($user -> getRole() == "teacher"): ?>
                                    <a href="/pages/teacher/my-courses.php" class="block py-1.5 px-5">My Courses</a>
                                    <a href="/pages/teacher/statistics.php" class="block py-1.5 px-5">Statistics</a>
                                <?php elseif($user -> getRole() == "admin"): ?>
                                    <a href="/pages/admin/users-list.php" class="block py-1.5 px-5">Users List</a>
                                    <a href="/pages/admin/reviews-list.php" class="block py-1.5 px-5">Reviews List</a>
                                    <a href="/pages/admin/categories-list.php" class="block py-1.5 px-5">Categories & Tags</a>
                                    <a href="/pages/admin/dashboard.php" class="block py-1.5 px-5">Dashboard</a>
                                <?php endif; ?>
                            </div>
                            <a href="/pages/logout.php" class="block py-2 px-5 border-t border-gray-300">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div>
                <a href="/index.php" class="font-semibold text-xl no-underline text-white" style="font-family: 'Playwrite IN', serif;"><span class="text-[#00A5CF]" style="font-family: 'Playwrite IN', serif;">Y</span>oudemy</a>
            </div>

            <div class="relative">
                <button type="button" class="bg-[#D9D9D9] search-btn bg-opacity-15 flex items-center py-2 px-5 text-[#B2B2B2] rounded-full w-36 border border-gray-500 justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-[#B2B2B2]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    <span>Search</span>
                </button>
                <div class="absolute z-20 top-16 left-1/2 hidden search-window w-screen max-w-lg rounded border border-gray-300 bg-white shadow-[0px_0px_10px_rgba(0,0,0,0.2)] px-4 py-5 -translate-x-1/2">
                    <div class="px-2">
                        <div class="items-center justify-between flex mb-3">
                            <label for="search-for" class="font-semibold">Search for</label>
                            <select class="search-option py-1.5 px-3 rounded bg-[#00A5CF20] border border-[#00A5CF] w-34" id="search-for">
                                <option value="courses">Courses</option>
                                <option value="teachers">Teachers</option>
                            </select>
                        </div>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-700 absolute top-2 left-3" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            <input type="text" placeholder="Type in something ..." class="outline-none search-input py-1.5 ps-10 placeholder:text-gray-600 px-3 rounded bg-[#00A5CF20] border border-[#00A5CF] w-full">
                        </div>
                    </div>
                    <div class="text-center my-5">
                        <span class="font-semibold px-3 bg-white relative z-10">Results</span>
                        <div class="w-52 h-px bg-gray-300 mx-auto relative bottom-3"></div>
                    </div>
                    <div class="results-screen flex flex-col gap-7 max-h-80 px-2 overflow-auto">
                        <p class="text-center text-gray-600">You have not searched yet</p>
                    </div>
                </div>
            </div>
            
            <div class="*:ml-6 *:font-semibold text-white">
                <a href="/index.php" class="<?php if ($_SERVER["SCRIPT_NAME"] == "/index.php") {echo "text-[#00A5CF]";} ?>">Home</a>
                <a href="/pages/courses.php" class="<?php if ($_SERVER["SCRIPT_NAME"] == "/pages/courses.php") {echo "text-[#00A5CF]";} ?>">Courses</a>
                <a href="/pages/login.php">Login</a>
                <a href="/pages/register.php">Register</a>
            </div>

        <?php endif; ?>

    </div>
</div>