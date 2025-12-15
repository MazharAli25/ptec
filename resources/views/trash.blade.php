
    <!-- Modal 1 -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <form action="" method="POST">
                <div class="flex flex-col">
                    <h1 class="font-bold text-[20px] text-center">Edit Student Details</h1>
                    <label for="studentName" class="mt-3">Student Name:</label>
                    <input type="text"
                        class="border border-gray-300 rounded-lg text-[14px] px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                        id="studentName" name="studentName">
                </div>
                <button data-close-modal="editModal"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition mt-2">Close</button>
            </form>
        </div>
    </div>
    <!-- Modal 2 -->
    <div id="modal2" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Modal 2</h2>
            <p class="text-gray-600 mb-6">This is another modal instance.</p>
            <div class="flex justify-end">
                <button data-close-modal="modal2"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Close</button>
            </div>
        </div>
    </div>
    <script>
        // Open modals
        document.querySelectorAll('[data-modal-target]').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-modal-target');
                const modal = document.getElementById(target);
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-close-modal');
                const modal = document.getElementById(target);
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });
        document.querySelectorAll('[id^="modal"]').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    </script>