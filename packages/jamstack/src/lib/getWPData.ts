export const wpContent = async () => {
  const makers = `mediaItems(where: {category: "maker"}, first: 50) {
    nodes {
      title,
      mediaType,
      mediaItemUrl,
      altText,
    }
  }`;
  const pages = `pages(where: {status: PUBLISH}, first: 100) {
    nodes {
      uri,
      id,
      title,
      content,
      excerpt,
      featuredImage {
        node {
          mediaType,
          mediaItemUrl,
          altText,
        }
      }
    }
  }`;
  const events = `events(where: {status: PUBLISH}, first: 100) {
    nodes {
      id,
      title,
      excerpt,
      content,
      categories {
        nodes {
          name,
        },
      },
      tags {
        nodes {
          name,
        },
      },
      uri,
      slug,
      featuredImage {
        node {
          mediaType,
          mediaItemUrl,
          altText,
        }
      }
    }
  }`;
  const posts = `posts(where: {status: PUBLISH}) {
    nodes {
      date,
      title,
      slug,
      excerpt
    }
  }`;
  // TODO: fetch state consts
  const menuItems = `menuItems(where: {location: MEGA, parentId: ""}, first: 1000) {
    nodes {
      label,
      title,
      target,
      path,
      parentId,
      childItems {
        nodes {
          label,
          title,
          target,
          path,
          parentId,
        }
      }
    }
  }`;
  const navItems = `navItems: menuItems(where: {location: NAV, parentId: ""}, first: 1000) {
    nodes {
      label,
      title,
      target,
      path,
    }
  }`;

  try {
    const API_URL =
      process.env.NODE_ENV !== 'development'
        ? typeof window !== 'undefined'
          ? process.env.NEXT_PUBLIC_API_URL
          : process.env.API_URL
        : typeof window !== 'undefined'
        ? 'http://aarons-macbook-pro.local:32769'
        : 'http://cms';
    const query = `{
    ${menuItems},
    ${navItems},
    ${makers},
    ${pages},
    ${events},
    ${posts}
  }`.replaceAll(/\s/gi, '');

    const res = await fetch(API_URL + `/graphql`, {
      method: 'post',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ query: query }),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors)
      json.errors.map((error: any) => {
        throw Error(error);
      });

    const megaMenu = [];
    for (const item of json.data.menuItems.nodes) {
      if (!item.parentId) megaMenu.push(item);
    }
    json.data.menuItems.nodes = megaMenu;

    return json.data;
  } catch (error: any) {
    console.error(error.message);

    return {
      notFound: true,
    };
  }
};
