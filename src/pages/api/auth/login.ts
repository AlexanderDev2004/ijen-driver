import type { APIRoute } from "astro";
import { prisma } from "../../../lib/prisma";
import bcrypt from "bcrypt";

export const POST: APIRoute = async ({ request, redirect }) => {
  const formData = await request.formData();
  const username = formData.get("username")?.toString();
  const password = formData.get("password")?.toString();

  if (!username || !password) {
    return new Response("Username and password are required", { status: 400 });
  }

  // Cari user di database
  const user = await prisma.user.findUnique({
  where: { username },
});


  if (!user) {
    return new Response("Invalid username or password", { status: 401 });
  }

  // Cek password
  const isValid = await bcrypt.compare(password, user.password);
  if (!isValid) {
    return new Response("Invalid username or password", { status: 401 });
  }

  
  return redirect("/admin/dashboard");
};
