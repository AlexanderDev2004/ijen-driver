import { PrismaClient } from "@prisma/client";
import bcrypt from "bcrypt";

const prisma = new PrismaClient();

async function main() {
  const hashedPassword = await bcrypt.hash("admin123", 10);

  await prisma.user.createMany({
    data: [
      {
        username: "admin",
        password: hashedPassword,
        email: "admin@ijen-driver.com",
      },
      {
        username: "demo",
        password: await bcrypt.hash("demo123", 10),
        email: "demo@ijen-driver.com",
      },
    ],
    skipDuplicates: true,
  });

  console.log("✅ Users seeded successfully");
}

main()
  .then(async () => {
    await prisma.$disconnect();
  })
  .catch(async (e) => {
    console.error(e);
    await prisma.$disconnect();
    process.exit(1);
  });
