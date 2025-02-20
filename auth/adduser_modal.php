
   <!-- Add User Modal -->
    <div id="adduser-modal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 text-center" id="modal-title">
                                Agregar Usuario
                            </h3>
                            <div class="mt-2">
                                <form id="adduser-form" action="/bolt/auth/adduser.php" method="POST" class="space-y-6">
                                    <div>
                                        <label for="modal-username" class="block text-sm font-medium text-gray-700">Usuario</label>
                                        <input type="text" id="modal-username" name="username" required
                                               class="form-input" style="margin-top: 0.25rem; display: block; width: 100%; border-radius: 0.375rem; border: 1px solid #d1d5db; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); background-color: #ffffff; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.5rem; padding-bottom: 0.5rem; line-height: 1.5rem; font-size: 1rem;">
                                    </div>
                                    <div>
                                        <label for="modal-password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                                        <input type="password" id="modal-password" name="password" required
                                               class="form-input" style="margin-top: 0.25rem; display: block; width: 100%; border-radius: 0.375rem; border: 1px solid #d1d5db; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); background-color: #ffffff; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.5rem; padding-bottom: 0.5rem; line-height: 1.5rem; font-size: 1rem;">
                                    </div>
                                     <div>
                        <label for="modal-role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="modal-role" name="role" required
                                class="form-input" style="margin-top: 0.25rem; display: block; width: 100%; border-radius: 0.375rem; border: 1px solid #d1d5db; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); background-color: #ffffff; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.5rem; padding-bottom: 0.5rem; line-height: 1.5rem; font-size: 1rem;">
                            <option value="user">Usuario Común</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="adduser-form"
        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3">
    Registrar
</button>
              <button type="button" onclick="closeAddUserModal()"
        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
    Cancelar
</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAddUserModal() {
            document.getElementById('adduser-modal').classList.remove('hidden');
        }

        function closeAddUserModal() {
            document.getElementById('adduser-modal').classList.add('hidden');
        }

        document.getElementById('open-adduser-modal').addEventListener('click', openAddUserModal);
        document.getElementById('open-adduser-modal-mobile').addEventListener('click', openAddUserModal);
    </script>
