<?php


namespace Command;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console;

class GenerateDatabaseCommand extends Console\Command\Command
{
    /**
     * @see Console\Command\Command
     */
    protected function configure()
    {
        $this
            ->setName('project:db:generate')
            ->setDescription('Generate the database schema.')
            ->setHelp(<<<EOT
Generate the database schema.
EOT
            );
    }

    /**
     * @see Console\Command\Command
     */
    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $conn = $this->getHelper('db')->getConnection();

        /* @var Connection $conn */
        $sm = $conn->getSchemaManager();
        $post = new Table("post");
        $post->addColumn("id", "integer",
            array("Autoincrement" => TRUE, array("length" => 10)));
        $post->addColumn("title", "string", array("length" => 256));
        $post->addColumn("author_name", "string", array("length" => 256));
        $post->addColumn("content", "string", array("length" => 256));
        $post->addColumn("created_at","datetime");
        $post->addIndex(array("title"));
        $post->setPrimaryKey(array("id"));

        $comment = new Table("comment");
        $comment->addColumn("id", "integer",
            array("Autoincrement" => TRUE, array("length" => 10)));
        $comment->addColumn("content", "string", array("length" => 256));
        $comment->addColumn("author_name", "string", array("length" => 256));
        $comment->addColumn("post_id", "integer", array("length" => 10));
        $comment->addColumn("created_at","datetime");
        $comment->setPrimaryKey(array("id"));
        $comment->addForeignKeyConstraint($post, array("post_id"), array("id"));

        if ($sm->tablesExist(array("comment")))
            $sm->dropTable("comment");
        if ($sm->tablesExist(array("post")))
            $sm->dropTable("post");

        $sm->createTable($post);
        $output->writeln("Creating table post");

        $sm->createTable($comment);
        $output->writeln("Creating table comment");

        $output->writeln("Database generated  ! ");


    }
}
